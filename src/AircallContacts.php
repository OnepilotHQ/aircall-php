<?php

namespace Aircall;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class AircallContacts.
 *
 * @see http://developer.aircall.io/#call
 */
class AircallContacts extends AircallBase
{
    protected static string $baseEndpoint = 'company';

    /**
     * Add phone number to a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addPhoneNumber( array $params = [])
    {
        $path = $this->endpoint();

        return $this->handleResponse(
            $this->client->post(
                $path.'/phone_details',
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Update a phone number from a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function updatePhoneNumber(int $phoneNumberId, array $params = [])
    {
        $path = $this->endpoint();

        return $this->handleResponse(
            $this->client->post(
                $path.'/phone_details/'.$phoneNumberId,
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Delete a Contact's phone number.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function deletePhoneNumber(int $phoneNumberId)
    {
        return $this->handleResponse(
            $this->client->delete(
                $this->endpoint().'/phone_details/'.
                $phoneNumberId
            )
        );
    }

    /**
     * Add email to a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addEmail(array $params = [])
    {
        $path = $this->endpoint();

        return $this->handleResponse(
            $this->client->post(
                $path.'/email_details',
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Update an email from a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function updateEmail(int $emailId, array $params = [])
    {
        $path = $this->endpoint();

        return $this->handleResponse(
            $this->client->post(
                $path.'/email_details/'.$emailId,
                $this->toGuzzleOptions($params)
            )
        );
    }

    /**
     * Delete an email form a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function deleteEmail(int $emailId)
    {
        return $this->handleResponse(
            $this->client->delete(
                $this->endpoint().'/email_details/'.
                $emailId
            )
        );
    }
}
