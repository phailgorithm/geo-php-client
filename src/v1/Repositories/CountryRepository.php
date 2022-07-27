<?php

namespace Phailgorithm\GeoClient\v1\Repositories;

use Phailgorithm\GeoClient\v1\Models\Country;

/**
 * Country repository classs for managing Country resources
 */
class CountryRepository
{

    /**
     * @var \GuzzleHttp\Client
     */
    private \GuzzleHttp\Client $client;

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get an optional country resource via unique intege id or unique string key
     *
     * @param integer|string $unique
     * @return Country|null
     * 
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int|string $unique): Country
    {
        $response = $this->client->get('countries/' . $unique);

        if ($response->getStatusCode() == 200) {
            return Country::fromJson(json_decode($response->getBody(), true));
        }

        return null;
    }

    /**
     * Get an optional country resource via unique intege id or unique string key
     *
     * @param integer|string $unique
     * @return Country|null
     */
    public function optional(int|string $unique): Country|null
    {
        try {
            $response = $this->client->get('countries/' . $unique);
            if ($response->getStatusCode() == 200) {
                return Country::fromJson(json_decode($response->getBody(), true));
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $exc) {
            return null;
        }
    }
}
