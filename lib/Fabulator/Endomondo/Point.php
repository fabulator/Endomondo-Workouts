<?php

namespace Fabulator\Endomondo;

/**
 * Class Point
 * @package Fabulator\Endomondo
 */
class Point {

    /**
     * @var \DateTime
     */
    private $time;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var float
     */
    private $altitude;

    /**
     * @var float
     */
    private $distance;

    /**
     * @var integer
     */
    private $duration;

    /**
     * @var integer
     */
    private $heartRate;

    /**
     * @var float
     */
    private $speed;

    /**
     * @var integer
     */
    private $instruction;

    /**
     * @var int
     */
    private $cadence;

    /**
     * Point constructor.
     */
    public function __construct() { }

    /**
     * @param \DateTime $time
     * @return $this
     */
    public function setTime(\DateTime $time) {
        $this->time = clone $time;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return clone $this->time;
    }

    /**
     * @param $latitude float
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param $longitude float
     * @return $this
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param $altitude float
     * @return $this
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;
        return $this;
    }

    /**
     * @return float
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * Set distance in kilometres.
     *
     * @param $distance float in kilometres
     * @return $this
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
        return $this;
    }

    /**
     * Get distance in kilometres.
     *
     * @return float in kilometres
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Get duration in seconds
     *
     * @param $duration integer in seconds
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * Get duration in seconds
     *
     * @return int duration in seconds
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param $heartRate integer
     * @return $this
     */
    public function setHeartRate($heartRate)
    {
        $this->heartRate = $heartRate;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeartRate()
    {
        return $this->heartRate;
    }

    /**
     * @param $speed float
     * @return $this
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * @return float
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set some start/stop instruction during the workout.
     *
     * @param $instruction int
     * @return $this
     */
    public function setInstruction($instruction)
    {
        $this->instruction = $instruction;
        return $this;
    }

    /**
     * Some start/stop instruction during the workout.
     *
     * @return int
     */
    public function getInstruction()
    {
        return $this->instruction ?: 2;
    }

    /**
     * @param $cadence int
     * @return $this
     */
    public function setCadence($cadence)
    {
        $this->cadence = $cadence;
        return $this;
    }

    /**
     * @return int
     */
    public function getCadence()
    {
        return $this->cadence;
    }

    /**
     * Convert point to string readable by Endomondo
     *
     * @return string
     */
    public function toString()
    {
        if ($this->getTime() !== null) {
            $time = $this->getTime()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d H:i:s \U\T\C');
        } else {
            $time = '';
        }
        return $time . ';' .
            $this->getInstruction() . ';' .
            $this->getLatitude() . ';' .
            $this->getLongitude() . ';' .
            $this->getDistance() . ';' .
            $this->getSpeed() . ';' .
            $this->getAltitude() . ';' .
            $this->getHeartRate() . ';' .
            $this->getCadence() . ';' .
            "\n";
    }
}