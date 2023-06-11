<?php

namespace App\Libraries;

require_once APPPATH . "ThirdParty/geoip2/vendor/autoload.php";

use GeoIp2\Database\Reader;

class GeoIP
{
    protected $reader;

    public function __construct()
    {
        $this->reader = new Reader(FCPATH . 'uploads/maxmind-db/GeoLite2-City.mmdb');
    }

    // Get Location
    public function getLocation($ip, $lang = 'es')
    {
        try {
            $record = $this->reader->city($ip);
            return [
                'country' => $record->country->names[$lang],
                'country_code' => $record->country->isoCode,
                'time_zone' => $record->location->timeZone,
                'city' => $record->city->name,
                'state' => $record->mostSpecificSubdivision->name,
                'ip' => $ip,
                'postal_code' => $record->postal->code,
            ];
        } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            return null;
        }
    }

    // Get Country
    public function getCountry($ipAddress)
    {
        try {
            $record = $this->reader->city($ipAddress);
            return $record->country->name;
        } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            return null;
        }
    }

    // Get Country ISO Code
    public function getCountryIsoCode($ipAddress)
    {
        try {
            $record = $this->reader->city($ipAddress);
            return $record->country->isoCode;
        } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            return null;
        }
    }

    // Get City
    public function getCity($ipAddress)
    {
        try {
            $record = $this->reader->city($ipAddress);
            return $record->city->name;
        } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            return null;
        }
    }

    // Get State
    public function getState($ipAddress)
    {
        try {
            $record = $this->reader->city($ipAddress);
            return $record->mostSpecificSubdivision->name;
        } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            return null;
        }
    }

    // Get Postal Code
    public function getPostalCode($ipAddress)
    {
        try {
            $record = $this->reader->city($ipAddress);
            return $record->postal->code;
        } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            return null;
        }
    }

    // Get Latitude
    public function getLatitude ($ipAddress)
    {
        try {
            $record = $this->reader->city($ipAddress);
            return $record->location->latitude;
        } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            return null;
        }
    }

    // Get Longitude
    public function getLongitude ($ipAddress)
    {
        try {
            $record = $this->reader->city($ipAddress);
            return $record->location->longitude;
        } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            return null;
        }
    }
}
