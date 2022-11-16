<?php

namespace Aircall;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class AircallUsers.
 *
 * @see http://developer.aircall.io/#user
 */
class AircallUsers extends AircallBase
{
    protected static string $baseEndpoint = 'users';

    /**
     * Start an outbound call.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function calls(int $id, array $params = [])
    {
        $path = $this->endpoint($id);

        return $this->handleResponse(
            $this->client->post(
                $path.'/calls',
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Dial a phone number in an agent's phone.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function dial(int $id, array $params = [])
    {
        $path = $this->endpoint($id);

        return $this->handleResponse(
            $this->client->post(
                $path.'/dial',
                $this->toGuzzleOptions($params)
            )
        );
    }
}
