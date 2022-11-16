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
        return $this->handleResponse($this->client->get($this->endpoint(), [
            'query' => $options
        ]));
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
        return $this->endpoint().'/'.$id;
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
        return $this->handleResponse(
            $this->client->post($this->endpoint(), [
                'json' => $options
            ])
        );
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
        $path = $this->endpoint($id);

        return $this->handleResponse(
            $this->client->post($path, [
                'json' => $options
            ])
        );
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
        $path = $this->endpoint($id);

        return $this->handleResponse($this->client->delete($path));
    }

    public function setEndpoint($endpoint)
    {
        static::$baseEndpoint = $endpoint;

        return $this;
    }

    public function endpoint(?int $id = null)
    {
        if(!$id){
            return static::$baseEndpoint;
        }

        return static::$baseEndpoint . '/' . $id;
    }

    public function search(array $options = [])
    {
        return $this->handleResponse($this->client->get($this->endpoint().'/search',[
            'query' => $options
        ]));
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
