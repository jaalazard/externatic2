<?php

namespace App\Service;

class DistanceCalculator
{
    public const EARTH_RADIUS = 6372.795477598;

    public function getDistance(Localizable $from, Localizable $destination): float
    {
        $deltaLat = $destination->getLatitude() - $from->getLatitude();
        $deltaLon = $destination->getLongitude() - $from->getLongitude();

        $alpha = $deltaLat / 2;
        $beta = $deltaLon / 2;
        $result =
            sin(deg2rad($alpha)) * sin(deg2rad($alpha))
            + cos(deg2rad($from->getLatitude()))
            * cos(deg2rad($destination->getLatitude()))
            * sin(deg2rad($beta))
            * sin(deg2rad($beta));
        $result = asin(min(1, sqrt($result)));

        $distance = 2 * self::EARTH_RADIUS * $result;
        $distance = round($distance, 4);

        return $distance;
    }

    public function isClose(Localizable $from, Localizable $destination, int $radius): bool
    {
        return $this->getDistance($from, $destination) <= $radius;
    }
}
