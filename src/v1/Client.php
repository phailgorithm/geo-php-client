<?php

namespace Phailgorithm\GeoClient\v1;

use Phailgorithm\GeoClient\v1\Repositories\CityRepository;
use Phailgorithm\GeoClient\v1\Repositories\CountryRepository;

/**
 * Http client for Geo microservice api
 */
class Client
{

    /**
     * @var \GuzzleHttp\Client
     */
    private \GuzzleHttp\Client $client;

    /**
     * Repository of City resources
     *
     * @var CityRepository
     */
    public readonly CityRepository $cities;

    /**
     * Repository of Country resources
     *
     * @var CountryRepository
     */
    public readonly CountryRepository $countries;

    public function __construct(string $url, string $token)
    {

        $this->client = new \GuzzleHttp\Client(
            [
                'base_uri' => $url . '/api/v1/',
                'headers' => [
                    'Accept' => 'application/json',
                    'User-Agent' => 'geo-php-client',
                    'X-Geo-Client-Version' => 'v0.1.0',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                ]
            ]
        );

        $this->cities = new CityRepository($this->client);
        $this->countries = new CountryRepository($this->client);
    }
}
