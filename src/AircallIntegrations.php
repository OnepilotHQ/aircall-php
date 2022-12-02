<?php

namespace Aircall;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class AircallCalls.
 *
 * @see http://developer.aircall.io/#call
 */
class AircallIntegrations extends AircallBase
{
    protected static string $baseEndpoint = 'integrations';

    public function me()
    {
        return $this->handleResponse(
            $this->client->get(
                $this->endpoint().'/me'
            )
        );
    }
}
