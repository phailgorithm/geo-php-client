<?php

namespace Phailgorithm\GeoClient\v1\Models;

/**
 * Dataclass for representing Country resource of Geo api
 */
class Country
{
    public function __construct(

        /**
         * Unique id of the Country
         *
         * @var int
         */
        public readonly int $id,

        /**
         * Unique human readable name of the Country
         *
         * @var string
         */
        public readonly string $key,

        /**
         * The name of the Country in a given locale
         *
         * @var string
         */
        public readonly string $name,
    ) {
    }

    /**
     * Factory function to create a Country object from a JSON parsed associative array
     *
     * @param array $json
     * @return Country
     */
    public static function fromJson(array $json): Country
    {
        return new Country(
            id: $json['id'],
            key: $json['key'],
            name: $json['name'],
        );
    }
}
