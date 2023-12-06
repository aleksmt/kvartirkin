<?php

namespace Kvartirkin\Helpers;


class GeoInfo
{
    /**
     * @var array $_i initial longitude and latitude
     */
    private $_i = [
        'latitude' => .0,
        'longitude' => .0,
    ];

    /**
     * Sets initial coordinates for the point to search from
     * @param float $latitude start point for the gps coordinates
     * @param float $longitude start point for the gps coordinates
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->_i['latitude'] = $latitude;
        $this->_i['longitude'] = $longitude;
    }

    /**
     * Calculate distance from the initial coordinates in kilometers, miles, etc.
     * @param float $latitude
     * @param float $longitude
     * @param string $unit possible values: 'K', 'M', 'M'
     * @return float distance
     */
    public function distanceTo(float $latitude, float $longitude, $unit = 'K') : float
    {
        if (($this->_i['latitude'] == $latitude) && ($this->_i['longitude'] == $longitude))
            return .0;

        $theta = deg2rad($this->_i['longitude'] - $longitude);

        $lat1 = deg2rad($this->_i['latitude']);
        $lat2 = deg2rad($latitude);

        $dist = sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($theta);
        $dist = rad2deg(acos($dist));

        $miles = $dist * 60 * 1.1515;

        switch (strtoupper($unit)) {
            case 'K':
                $d = $miles * 1.609344;
                break;
            case 'N':
                $d = $miles * 0.8684;
                break;
            case 'M':
            default:
                $d = $miles;
                break;
        }

        return $d;
    }

}