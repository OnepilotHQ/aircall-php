<?php

namespace Aircall;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class AircallCalls.
 *
 * @see http://developer.aircall.io/#call
 */
class AircallCalls extends AircallBase
{
    protected static string $baseEndpoint = 'calls';

    /**
     * Display a link in-app to the User who answered a specific Call.
     *
     * @deprecated since 2019-11-21 available on the Call object
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function link(int $id, array $params = [])
    {
        $path = $this->endpoint($id);

        return $this->handleResponse(
            $this->client->post(
                $path.'/link',
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Transfer the Call to another user.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function transfert(int $id, array $params = [])
    {
        $path = $this->endpoint($id);

        return $this->handleResponse(
            $this->client->post(
                $path.'/transfers',
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Comment the Call.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function comment(int $id, array $params = [])
    {
        $path = $this->endpoint($id);

        return $this->handleResponse(
            $this->client->post(
                $path.'/comments',
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Pause recording on a live Call.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function pauseRecording(int $id, array $params = [])
    {
        $path = $this->endpoint($id);

        return $this->handleResponse(
            $this->client->post(
                $path.'/pause_recording',
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Resume recording on a live Call.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function resumeRecording(int $id, array $params = [])
    {
        $path = $this->endpoint($id);

        return $this->handleResponse(
            $this->client->post(
                $path.'/resume_recording',
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Display custom informations during a Call in the Phone app.
     *
     * @deprecated since 2019-11-21 available on the Call object
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function getMetadata(int $id, array $params = [])
    {
        $path = $this->endpoint($id);

        return $this->handleResponse(
            $this->client->post(
                $path.'/metadata',
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Set the Tags for a specific Call.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function setTags(int $id, array $params = [])
    {
        $path = $this->endpoint($id);

        return $this->handleResponse(
            $this->client->post(
                $path.'/tags',
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Delete the recording of a specific Call.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function deleteRecording(int $id)
    {
        $path = $this->endpoint($id);

        return $this->handleResponse(
            $this->client->delete($path.'/recording')
        );
    }

    /**
     * Delete the voicemail of a specific Call.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function deleteVoicemail(int $id, array $params = [])
    {
        $path = $this->endpoint($id);

        return $this->handleResponse(
            $this->client->delete(
                $path.'/voicemail',
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Comment a specific Call.
     *
     * @param int        $id
     * @param array|string $params Send the comment with with array ['content' => 'Lorem'] or string, only the content
     * @return mixed
     * @throws GuzzleException
     */
    public function comments(int $id, array|string $params)
    {
        $path = $this->endpoint($id);

        $params = is_string($params) ? [$params] : $params;

        return $this->handleResponse(
            $this->client->post(
                $path.'/comments',
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Add Insight Cards display custom data to Agents in their Phone apps during ongoing Calls.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addInsightCards(int $id, array $params = [])
    {
        $path = $this->endpoint($id);

        return $this->handleResponse(
            $this->client->post(
                $path.'/insight_cards',
                $this->toGuzzleOptions($params)
            )
        );
    }
}
