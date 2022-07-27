<?php

namespace Phailgorithm\GeoClient\v1\Models;

/**
 * Dataclass for representing GeoJson coordinates
 */
class Coords
{

    public function __construct(
        /**
         * Latitude part of the coordinates
         *
         * @var string latitude
         */
        public readonly string $lat,

        /**
         * Longitude part of the coordinates
         *
         * @var string longitude
         */
        public readonly string $lng
    ) {
    }

    /**
     * Factory function to create a Coords object from a JSON parsed associative array
     *
     * @param array $json
     * @return Coords
     */
    public static function fromJson(array $json): Coords
    {
        return new Coords(lat: $json['x'], lng: $json['y']);
    }
}
