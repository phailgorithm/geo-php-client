<?php

namespace Phailgorithm\GeoClient\v1\Models;

/**
 * Base interface to be implemented for all models
 */
interface Model
{
    /**
     * Convert standard model class to an associative array
     *
     * @return array
     */
    public function toArray(): array;
}
