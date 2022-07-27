<?php

spl_autoload_register(
    function ($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'phailgorithm\\geoclient\\v1\\models\\city' => '/v1/Models/City.php',
                'phailgorithm\\geoclient\\v1\\models\\coords' => '/v1/Models/Coords.php',
                'phailgorithm\\geoclient\\v1\\models\\country' => '/v1/Models/Country.php',
                'phailgorithm\\geoclient\\v1\\repositories\\cityrepository' => '/v1/Repositories/CityRepository.php',
                'phailgorithm\\geoclient\\v1\\repositories\\countryrepository' => '/v1/Repositories/CountryRepository.php',
                'phailgorithm\\geoclient\\v1\\httpclient' => '/v1/Client.php',
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    },
    true,
    false
);
