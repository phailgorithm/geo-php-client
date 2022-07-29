<?php

namespace Phailgorithm\GeoClient\v1\Repositories;

use Phailgorithm\GeoClient\v1\Models\City;

/**
 * City repository class for managing City resources
 */
class CityRepository
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
     * Get a city resource via unique intege id or unique string key
     *
     * @param integer|string $unique
     * @return City|null
     * 
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int|string $unique): City
    {
        $response = $this->client->get('cities/' . $unique);

        if ($response->getStatusCode() == 200) {
            return City::fromJson(json_decode($response->getBody(), true));
        }
    }


    /**
     * Get an optional city resource via unique intege id or unique string key
     *
     * @param integer|string $unique
     * @return City|null
     */
    public function optional(int|string $unique): City|null
    {
        try {
            $response = $this->client->get('cities/' . $unique);
            if ($response->getStatusCode() == 200) {
                return City::fromJson(json_decode($response->getBody(), true));
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $exc) {
            return null;
        }
    }

    /**
     * Get a list of cities closed to a given city
     *
     * @param integer|string $unique
     * @param integer $limit
     * @return City[]
     */
    public function nearby(int|string $unique, int $limit = 21): array
    {
        $cities = [];
        $response = $this->client->get('cities/' . $unique . '/nearby', ['query' => [
            'limit' => $limit
        ]]);

        if ($response->getStatusCode() == 200) {
            foreach (json_decode($response->getBody(), true) as $city) {
                array_push($cities, City::fromJson($city));
            }
        }

        return $cities;
    }

    /**
     * Get a list of top cities in a given country
     *
     * @param integer|string $country
     * @param integer $limit
     * @return City[]
     */
    public function top(int|string $country, int $limit = 30): array
    {
        $cities = [];
        $response = $this->client->get('countries/' . $country . '/cities', ['query' => [
            'limit' => $limit
        ]]);

        if ($response->getStatusCode() == 200) {
            foreach (json_decode($response->getBody(), true) as $city) {
                array_push($cities, City::fromJson($city));
            }
        }

        return $cities;
    }
}
