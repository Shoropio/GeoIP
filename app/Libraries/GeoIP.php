<?php

namespace App\Libraries;
use GeoIp2\Database\Reader;

class GeoIP
{
    protected $reader;

    public function __construct()
    {
        $this->reader = new Reader(APPPATH . '/Database/GeoLite2-City.mmdb');
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
    public function getCountry($ip, $lang = 'es')
    {
        try {
            $record = $this->reader->city($ip);
            return $record->country->names[$lang];
        } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            return null;
        }
    }

    // Get Country ISO Code
    public function getCountryIsoCode($ip)
    {
        try {
            $record = $this->reader->city($ip);
            return $record->country->isoCode;
        } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            return null;
        }
    }

    // Get City
    public function getCity($ip, $lang = 'es')
    {
        try {
            $record = $this->reader->city($ip);
            return $record->city->names[$lang];
        } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            return null;
        }
    }

    // Get State
    public function getState($ip)
    {
        try {
            $record = $this->reader->city($ip);
            return $record->mostSpecificSubdivision->name;
        } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            return null;
        }
    }
}
