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
    public function addPhoneNumber(int $id, array $options = [])
    {
        $path = $this->path($id);

        return $this->client->post($path.'/phone_details', $options);
    }

    /**
     * Update a phone number from a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function updatePhoneNumber(int $contactId, int $phoneNumberId, array $options = [])
    {
        $path = $this->path($contactId);

        return $this->client->post($path.'/phone_details/'.$phoneNumberId, $options);
    }

    /**
     * Delete a Contact's phone number.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function deletePhoneNumber(int $contactId, int $phoneNumberId)
    {
        return $this->client->delete($this->endpoint().'/phone_details/'.$phoneNumberId);
    }

    /**
     * Add email to a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addEmail(int $id, array $options = [])
    {
        $path = $this->path($id);

        return $this->client->post($path.'/email_details', $options);
    }

    /**
     * Update an email from a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function updateEmail(int $contactId, int $emailId, array $options = [])
    {
        $path = $this->path($contactId);

        return $this->client->post($path.'/email_details/'.$emailId, $options);
    }

    /**
     * Delete an email form a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function deleteEmail(int $contactId, int $emailId)
    {
        return $this->client->delete($this->endpoint().'/email_details/'.$emailId);
    }
}
