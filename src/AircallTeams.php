<?php

namespace Aircall;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class AircallTeams.
 */
class AircallTeams extends AircallBase
{
    protected static string $baseEndpoint = 'teams';

    /**
     * Add a User to a Team.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addUser(int $teamId, int $userId)
    {
        $path = $this->path($teamId);

        return $this->client->post($path.'/users/'.$userId);
    }

    /**
     * Remove a User from a Team.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function removeUser(int $teamId, int $userId)
    {
        $path = $this->path($teamId);

        return $this->client->delete($path.'/users/'.$userId);
    }

}
