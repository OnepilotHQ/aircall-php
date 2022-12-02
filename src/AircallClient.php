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
    protected AircallIntegrations $integrations;
    private Client $client;

    protected AircallBase $base;

    public AircallUsers $users;

    public AircallCalls $calls;

    public AircallContacts $contacts;

    public AircallTeams $teams;

    public function __construct(protected string $apiID, protected string $apiToken, $uri = 'https://api.aircall.io')
    {
        static::$baseUri = $uri;
        $this->setDefaultClient();

        $this->base = new AircallBase($this->client);
        $this->users = new AircallUsers($this->client);
        $this->calls = new AircallCalls($this->client);
        $this->contacts = new AircallContacts($this->client);
        $this->teams = new AircallTeams($this->client);
        $this->integrations = new AircallIntegrations($this->client);
    }

    public function __get(string $name)
    {
        $this->base->setEndpoint($name);
        return $this->base;
    }

    private function setDefaultClient(): void
    {
        $this->client = new Client([
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
        $this->client = $client;
        return $this;
    }

    /**
     * Sends POST request to Aircall API.
     *
     * @param string $endpoint
     * @param array  $data
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function post($endpoint, $data = [])
    {
        $response = $this->client->post($endpoint, [
            'json' => $data
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Sends PUT request to Aircall API.
     *
     * @param string $endpoint
     * @param array  $data
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function put($endpoint, $data = [])
    {
        $response = $this->client->put($endpoint, [
            'json' => $data
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Sends DELETE request to Aircall API.
     *
     * @param string $endpoint
     * @param array  $data
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete($endpoint, $data = [])
    {
        $response = $this->client->delete($endpoint, [
            'json' => $data
        ]);

        return $this->handleResponse($response);
    }

    /**
     * @param string $endpoint
     * @param array  $$data
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get($endpoint, $data = [])
    {
        $response = $this->client->get($endpoint, [
            'query' => $data
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
