<?php

use PHPUnit\Framework\TestCase;
use Phailgorithm\GeoClient\v1\Client;

final class GeoClientTest extends TestCase
{
    private Client $client;

    public function setUp(): void
    {
        $this->client = new Client('http://localhost:3000', 's3cr3t');
    }

    public function testGetCityByKey(): void
    {
        $city = $this->client->cities->get('roma');
        $this->assertInstanceOf('Phailgorithm\GeoClient\v1\Models\City', $city);

        $this->assertEquals($city->id, 3169070);
        $this->assertEquals($city->key, 'roma');
        $this->assertEquals($city->name, 'Roma');
        $this->assertEquals($city->population, 2563241);

        $this->assertInstanceOf('Phailgorithm\GeoClient\v1\Models\Coords', $city->coords);
        $this->assertEquals($city->coords->lat, '12.4839');
        $this->assertEquals($city->coords->lng, '41.89474');
    }

    public function testGetCityByMissingKey(): void
    {
        $null = $this->client->cities->optional('xyz');
        $this->assertNull($null);
    }

    public function testGetCityById(): void
    {
        $city = $this->client->cities->get(3169070);
        $this->assertInstanceOf('Phailgorithm\GeoClient\v1\Models\City', $city);

        $this->assertEquals($city->id, 3169070);
        $this->assertEquals($city->key, 'roma');
        $this->assertEquals($city->name, 'Roma');
        $this->assertEquals($city->population, 2563241);

        $this->assertInstanceOf('Phailgorithm\GeoClient\v1\Models\Coords', $city->coords);
        $this->assertEquals($city->coords->lat, '12.4839');
        $this->assertEquals($city->coords->lng, '41.89474');
    }

    public function testGetCityByMissingId(): void
    {
        $null = $this->client->cities->optional(1);
        $this->assertNull($null);
    }

    public function testGetCountryByKey(): void
    {
        $country = $this->client->countries->get('italia');
        $this->assertInstanceOf('Phailgorithm\GeoClient\v1\Models\Country', $country);

        $this->assertEquals($country->id, 3175395);
        $this->assertEquals($country->key, 'italia');
        $this->assertEquals($country->name, 'Italia');
    }

    public function testGetCountryByMissingKey(): void
    {
        $null = $this->client->countries->optional('xyz');
        $this->assertNull($null);
    }

    public function testGetCountryById(): void
    {
        $country = $this->client->countries->get(3175395);
        $this->assertInstanceOf('Phailgorithm\GeoClient\v1\Models\Country', $country);

        $this->assertEquals($country->id, 3175395);
        $this->assertEquals($country->key, 'italia');
        $this->assertEquals($country->name, 'Italia');
    }

    public function testGetCountryByMissingId(): void
    {
        $null = $this->client->countries->optional(1);
        $this->assertNull($null);
    }
}
