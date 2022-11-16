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
     * Search Calls.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */

    /**
     * Display a link in-app to the User who answered a specific Call.
     *
     * @deprecated since 2019-11-21 available on the Call object
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function link(int $id, array $options = [])
    {
        $path = $this->endpoint($id);

        return $this->client->post($path.'/link', $options);
    }

    /**
     * Transfer the Call to another user.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function transfert(int $id, array $options = [])
    {
        $path = $this->endpoint($id);

        return $this->client->post($path.'/transfers', $options);
    }

    /**
     * Comment the Call.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function comment(int $id, array $options = [])
    {
        $path = $this->endpoint($id);

        return $this->client->post($path.'/comments', $options);
    }

    /**
     * Pause recording on a live Call.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function pauseRecording(int $id, array $options = [])
    {
        $path = $this->endpoint($id);

        return $this->client->post($path.'/pause_recording', $options);
    }

    /**
     * Resume recording on a live Call.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function resumeRecording(int $id, array $options = [])
    {
        $path = $this->endpoint($id);

        return $this->client->post($path.'/resume_recording', $options);
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
    public function getMetadata(int $id, array $options = [])
    {
        $path = $this->endpoint($id);

        return $this->client->post($path.'/metadata', $options);
    }

    /**
     * Set the Tags for a specific Call.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function setTags(int $id, array $options = [])
    {
        $path = $this->endpoint($id);

        return $this->client->post($path.'/tags', $options);
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

        return $this->client->delete($path.'/recording');
    }

    /**
     * Delete the voicemail of a specific Call.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function deleteVoicemail(int $id, array $options = [])
    {
        $path = $this->endpoint($id);

        return $this->client->delete($path.'/voicemail', $options);
    }

    /**
     * Add Insight Cards display custom data to Agents in their Phone apps during ongoing Calls.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addInsightCards(int $id, array $options = [])
    {
        $path = $this->endpoint($id);

        return $this->client->post($path.'/insight_cards', $options);
    }
}
