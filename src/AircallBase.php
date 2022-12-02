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
    protected mixed $id;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function for($id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
    /**
     * Lists.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function list(array $params = [])
    {
        return $this->handleResponse(
            $this->client->get(
                $this->endpoint(),
                $this->toGuzzleQuery($params))
        );
    }

    /**
     * Retrieve an item.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get()
    {
        $path = $this->endpoint();

        return $this->handleResponse(
            $this->client->get($path)
        );
    }


    /**
     * Creates a item.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function create(array $params = [])
    {
        return $this->handleResponse(
            $this->client->post(
                $this->endpoint(),
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Update data for a specific item.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function update(array $params = [])
    {
        $path = $this->endpoint();
        return $this->handleResponse(
            $this->client->post(
                $path,
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Delete a specific item.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete()
    {
        $path = $this->endpoint();

        return $this->handleResponse(
            $this->client->delete($path)
        );
    }

    public function setEndpoint($endpoint)
    {
        static::$baseEndpoint = $endpoint;

        return $this;
    }

    public function endpoint()
    {
        if(!$this->getId()){
            return static::$baseEndpoint;
        }

        return static::$baseEndpoint . '/' . $this->getId();
    }

    public function search(array $params = [])
    {
        return $this->handleResponse(
            $this->client->get(
                $this->endpoint().'/search',
                $this->toGuzzleQuery($params))
        );
    }

    protected function toGuzzleOptions(array $params): array
    {
        return [
            'json' => $params
        ];
    }

    protected function toGuzzleQuery(array $params): array
    {
        return [
            'query' => $params
        ];
    }

    /**
     * @return mixed
     */
    protected function handleResponse(ResponseInterface $response): mixed
    {
        $stream = Utils::streamFor($response->getBody());

        return json_decode($stream);
    }
}
