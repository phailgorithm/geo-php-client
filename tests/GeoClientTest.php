<?php

use PHPUnit\Framework\TestCase;
use Phailgorithm\GeoClient\v1\Client;

final class GeoClientTest extends TestCase
{
    private Client $client;

    public function setUp(): void
    {
        $this->client = new Client($_ENV['GEO_API_URL'], $_ENV['GEO_API_SECRET']);
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

    public function testGetNearbyCities(): void
    {
        $cities = $this->client->cities->nearby('roma', 3);

        $this->assertIsArray($cities);
        $this->assertEquals(count($cities), 3);

        foreach ($cities as $city) {
            $this->assertInstanceOf('Phailgorithm\GeoClient\v1\Models\City', $city);
            $this->assertInstanceOf('Phailgorithm\GeoClient\v1\Models\Coords', $city->coords);
        }

        $this->assertEquals($cities[0]->id, 11396177);
        $this->assertEquals($cities[0]->key, 'aurelio');
        $this->assertEquals($cities[0]->name, 'Aurelio');
        $this->assertEquals($cities[0]->population, 0);
        $this->assertEquals($cities[0]->coords->lat, '12.44102');
        $this->assertEquals($cities[0]->coords->lng, '41.8974');

        $this->assertEquals($cities[1]->id, 11396182);
        $this->assertEquals($cities[1]->key, 'trionfale');
        $this->assertEquals($cities[1]->name, 'Trionfale');
        $this->assertEquals($cities[1]->population, 0);
        $this->assertEquals($cities[1]->coords->lat, '12.43934');
        $this->assertEquals($cities[1]->coords->lng, '41.91717');

        $this->assertEquals($cities[2]->id, 3174461);
        $this->assertEquals($cities[2]->key, 'lunghezza');
        $this->assertEquals($cities[2]->name, 'Lunghezza');
        $this->assertEquals($cities[2]->population, 1);
        $this->assertEquals($cities[2]->coords->lat, '12.58333');
        $this->assertEquals($cities[2]->coords->lng, '41.91667');
    }

    public function testGetTopCities(): void
    {
        $cities = $this->client->cities->top('italia', 3);

        $this->assertIsArray($cities);
        $this->assertEquals(count($cities), 3);

        foreach ($cities as $city) {
            $this->assertInstanceOf('Phailgorithm\GeoClient\v1\Models\City', $city);
            $this->assertInstanceOf('Phailgorithm\GeoClient\v1\Models\Coords', $city->coords);
        }

        $this->assertEquals($cities[0]->id, 3169070);
        $this->assertEquals($cities[0]->key, 'roma');
        $this->assertEquals($cities[0]->name, 'Roma');
        $this->assertEquals($cities[0]->population, 2563241);
        $this->assertEquals($cities[0]->coords->lat, '12.4839');
        $this->assertEquals($cities[0]->coords->lng, '41.89474');

        $this->assertEquals($cities[1]->id, 3173435);
        $this->assertEquals($cities[1]->key, 'milano');
        $this->assertEquals($cities[1]->name, 'Milano');
        $this->assertEquals($cities[1]->population, 1306661);
        $this->assertEquals($cities[1]->coords->lat, '9.18951');
        $this->assertEquals($cities[1]->coords->lng, '45.46427');

        $this->assertEquals($cities[2]->id, 3172394);
        $this->assertEquals($cities[2]->key, 'napoli');
        $this->assertEquals($cities[2]->name, 'Napoli');
        $this->assertEquals($cities[2]->population, 959574);
        $this->assertEquals($cities[2]->coords->lat, '14.25');
        $this->assertEquals($cities[2]->coords->lng, '40.83333');
    }
}
