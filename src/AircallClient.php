<?php

namespace Aircall;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\ResponseInterface;

/**
 * @property AircallBase $webhooks
 * @property AircallBase $numbers
 * @property AircallBase $tags
 * @property AircallBase $company
 */
class AircallClient
{
    protected static string $baseUri = 'api.aircall.io';

    private Client $http_client;

    protected AircallBase $base;

    public AircallUsers $users;

    public AircallCalls $calls;

    public AircallContacts $contacts;

    public AircallTeams $teams;

    public function __construct(protected string $apiID, protected string $apiToken, $uri = 'api.aircall.io')
    {
        static::$baseUri = $uri;
        $this->base = new AircallBase($this);
        $this->users = new AircallUsers($this);
        $this->calls = new AircallCalls($this);
        $this->contacts = new AircallContacts($this);
        $this->teams = new AircallTeams($this);
        $this->setDefaultClient();
    }

    public function __get(string $name)
    {
        $this->base->setEndpoint($name);
        return $this->base;
    }

    private function setDefaultClient(): void
    {
        $this->http_client = new Client([
            'base_uri' => static::$baseUri .'/v1/',
            'headers' => [
                'Authorization' =>  trim('Bearer '.$this->apiToken)
            ]
        ]);
    }

    /**
     * Sets GuzzleHttp client.
     *
     * @param Client $client
     */
    public function setClient(Client $client): static
    {
        $this->http_client = $client;
        return $this;
    }

    /**
     * Sends POST request to Aircall API.
     *
     * @param string $endpoint
     * @param array  $datas
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function post($endpoint, $datas = [])
    {
        $response = $this->http_client->request('POST', $endpoint, [
            'json' => $datas,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Sends PUT request to Aircall API.
     *
     * @param string $endpoint
     * @param array  $datas
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function put($endpoint, $datas = [])
    {
        $response = $this->http_client->request('PUT', $endpoint, [
            'json' => $datas,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Sends DELETE request to Aircall API.
     *
     * @param string $endpoint
     * @param array  $datas
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete($endpoint, $datas = [])
    {
        $response = $this->http_client->request('DELETE', $endpoint, [
            'json' => $datas,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return $this->handleResponse($response);
    }

    /**
     * @param string $endpoint
     * @param array  $$datas
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get($endpoint, $datas = [])
    {
        $response = $this->http_client->request('GET', $endpoint, [
            'query' => $datas,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return $this->handleResponse($response);
    }

    public function ping()
    {
        return $this->get('ping', []);
    }

    /**
     * @return mixed
     */
    private function handleResponse(ResponseInterface $response)
    {
        $stream = Utils::streamFor($response->getBody());

        return json_decode($stream);
    }
}
