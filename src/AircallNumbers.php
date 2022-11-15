<?php

namespace Aircall;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class AircallNumbers.
 *
 * @see http://developer.aircall.io/#number
 */
class AircallNumbers extends AircallBase
{
    protected static string $baseEndpoint = 'numbers';

}
