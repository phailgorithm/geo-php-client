<?php

namespace Phailgorithm\GeoClient\v1\Models;

use Phailgorithm\GeoClient\v1\Models\Coords;

/**
 * Dataclass for representing City resource of Geo api
 */
class City
{

    public function __construct(

        /**
         * Unique id of the City
         *
         * @var integer
         */
        public readonly int $id,

        /**
         * Unique human readable name of the City
         *
         * @var string
         */
        public readonly string $key,

        /**
         * The name of the City in a given locale
         *
         * @var string
         */
        public readonly string $name,

        /**
         * The GeoJson coordinates of the City
         *
         * @var Coords
         */
        public readonly Coords $coords,

        /**
         * The population count of the City
         *
         * @var integer
         */
        public readonly int $population,
    ) {
    }

    /**
     * Factory function to create a City object from a JSON parsed associative array
     *
     * @param array $json
     * @return City
     */
    public static function fromJson(array $json): City
    {
        return new City(
            id: $json['id'],
            key: $json['key'],
            name: $json['name'],
            coords: Coords::fromJson($json['coords']),
            population: $json['population'],
        );
    }
}
