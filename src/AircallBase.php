<?php

namespace Aircall;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\ResponseInterface;

/**
 * Class AircallUsers.
 *
 * @see http://developer.aircall.io/#user
 */
class AircallBase
{
    protected static string $baseEndpoint = '';

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Lists.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function list(array $options = [])
    {
        return $this->handleResponse($this->client->get(static::$baseEndpoint, $options));
    }

    /**
     * Retrieve an item.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get(int $id)
    {
        $path = $this->userPath($id);

        return $this->handleResponse($this->client->get($path));
    }


    public function userPath(int $id): string
    {
        return static::$baseEndpoint.'/'.$id;
    }

    /**
     * Creates a item.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function create(array $options = [])
    {
        return $this->handleResponse($this->client->post(static::$baseEndpoint, $options));
    }

    /**
     * Update data for a specific item.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function update(int $id, array $options = [])
    {
        $path = $this->path($id);

        return $this->handleResponse($this->client->post($path, $options));
    }

    /**
     * Delete a specific item.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete(int $id)
    {
        $path = $this->path($id);

        return $this->handleResponse($this->client->delete($path));
    }

    protected function path(int $id): string
    {
        return static::$baseEndpoint.'/'.$id;
    }

    public function setEndpoint($endpoint)
    {
        static::$baseEndpoint = $endpoint;

        return $this;
    }

    public function endpoint()
    {
        return static::$baseEndpoint;
    }

    public function search(array $options = [])
    {
        return $this->handleResponse($this->client->get($this->endpoint().'/search', $options));
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
