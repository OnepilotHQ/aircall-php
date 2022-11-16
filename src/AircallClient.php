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
    protected static string $baseUri;

    private Client $http_client;

    protected AircallBase $base;

    public AircallUsers $users;

    public AircallCalls $calls;

    public AircallContacts $contacts;

    public AircallTeams $teams;

    public function __construct(protected string $apiID, protected string $apiToken, $uri = 'https://api.aircall.io')
    {
        static::$baseUri = $uri;
        $this->setDefaultClient();

        $this->base = new AircallBase($this->http_client);
        $this->users = new AircallUsers($this->http_client);
        $this->calls = new AircallCalls($this->http_client);
        $this->contacts = new AircallContacts($this->http_client);
        $this->teams = new AircallTeams($this->http_client);
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
                'Authorization' =>  trim('Bearer '.$this->apiToken),
                'headers' => [
                    'Accept' => 'application/json',
                ],
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
            'json' => $datas
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
            'json' => $datas
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
            'json' => $datas
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
            'query' => $datas
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
