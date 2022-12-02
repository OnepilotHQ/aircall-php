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
    public function link(array $params = [])
    {
        $path = $this->endpoint();

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
    public function transfert(array $params = [])
    {
        $path = $this->endpoint();

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
    public function comment(array $params = [])
    {
        $path = $this->endpoint();

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
    public function pauseRecording(array $params = [])
    {
        $path = $this->endpoint();

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
    public function resumeRecording(array $params = [])
    {
        $path = $this->endpoint();

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
    public function getMetadata(array $params = [])
    {
        $path = $this->endpoint();

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
    public function setTags(array $params = [])
    {
        $path = $this->endpoint();

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
    public function deleteRecording()
    {
        $path = $this->endpoint();

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
    public function deleteVoicemail(array $params = [])
    {
        $path = $this->endpoint();

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
     * @param array|string $params Send the comment with with array ['content' => 'Lorem'] or string, only the content
     * @return mixed
     * @throws GuzzleException
     */
    public function comments(array|string $params)
    {
        $path = $this->endpoint();

        $params = is_string($params) ? [
            'content' => $params
        ] : $params;

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
    public function addInsightCards(array $params = [])
    {
        $path = $this->endpoint();

        return $this->handleResponse(
            $this->client->post(
                $path.'/insight_cards',
                $this->toGuzzleOptions($params)
            )
        );
    }
}
