<?php

namespace Fabulator\Endomondo;

/**
 * Class Workout
 * @package Fabulator\Endomondo
 */
class Workout {

    /**
     * @var array
     */
    private $source;

    /**
     * @var integer
     */
    private $typeId;

    /**
     * @var float
     */
    private $calories;

    /**
     * @var integer duration in seconds
     */
    private $duration;

    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * @var string
     */
    private $id;

    /**
     * @var float distane in km
     */
    private $distance;

    /**
     * @var Point[]
     */
    private $points = [];

    /**
     * @var int
     */
    private $avgHeartRate;

    /**
     * @var int
     */
    private $maxHeartRate;

    /**
     * @var string
     */
    private $message;

    /**
     * @var int
     */
    private $privacyMap;

    /**
     * @var int
     */
    private $privacyWorkout;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string[]
     */
    private $hashtags;

    /**
     * @var float
     */
    private $ascent;

    /**
     * @var float
     */
    private $descent;

    /**
     * @var int
     */
    private $cadence;

    /**
     * Create Endomondo workout.
     *
     * Workout constructor.
     */
    public function __construct() { }

    /**
     * Get workout type id.
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set workout type id.
     *
     * @param $id integer
     * @return $this
     * @throws EndomondoWorkoutException when workout type is unknown.
     */
    public function setTypeId($id)
    {
        if (!WorkoutType::exist($id)) {
            throw new EndomondoWorkoutException('Unknown workout type');
        };

        $this->typeId = $id;
        return $this;
    }

    /**
     * Get human readable workout type.
     *
     * @return string
     */
    public function getTypeName()
    {
        if ($this->getTypeId() !== null) {
            return WorkoutType::getName($this->getTypeId());
        }

        return null;
    }

    /**
     * Set number of calories.
     *
     * @param $calories float
     * @return $this
     */
    public function setCalories($calories)
    {
        $this->calories = $calories;
        return $this;
    }

    /**
     * Get number of calories.
     *
     * @return float
     */
    public function getCalories()
    {
        return $this->calories;
    }

    /**
     * Get duration in seconds.
     *
     * @param $duration integer
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * Get duration in seconds.
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Get workout start time.
     *
     * @param \DateTime $start
     * @return $this
     */
    public function setStart(\DateTime $start)
    {
        $this->start = clone $start;
        return $this;
    }

    /**
     * Get start time.
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return clone $this->start;
    }

    /**
     * Set end time.
     *
     * @param \DateTime $end
     * @return $this
     */
    public function setEnd(\DateTime $end)
    {
        $this->end = clone $end;
        return $this;
    }

    /**
     * Get time of end of workout. It can be manual set or it is counted based on start and duration.
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        // if end property is defined, use it
        if ($this->end) {
            return clone $this->end;
        }

        $numberOfPosts = count($this->getPoints());

        // try to find last time of point and use it as end date
        if ($this->haveGPSData()) {
            return $this->getPoints()[$numberOfPosts - 1]->getTime();
        }

        // if there are no points, calculate end date from duration
        return $this->getStart()->add(new \DateInterval('PT' . $this->getDuration() . 'S'));
    }

    /**
     * Set workout Id.
     *
     * @param $id string
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get workout id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set distance in kilometres.
     *
     * @param $distance float
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
     * @return float
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set points.
     *
     * @param $points Point[]
     * @return $this
     */
    public function setPoints($points) {
        $this->points = $points;
        return $this;
    }

    /**
     * Get points.
     *
     * @return Point[]
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Have workout some GPS data?
     *
     * @return bool
     */
    public function haveGPSData()
    {
        return count($this->getPoints()) > 0 && $this->getPoints()[0]->getLatitude();
    }

    /**
     * Get array of points as single string.
     *
     * @return string
     */
    public function getPointsAsString()
    {
        $points = '';

        foreach ($this->getPoints() as $point) {
            $points .= $point->toString();
        }

        return $points;
    }

    /**
     * Set avg heart rate.
     *
     * @param $hr int
     * @return $this
     */
    public function setAvgHeartRate($hr)
    {
        $this->avgHeartRate = $hr;
        return $this;
    }

    /**
     * Get avg heart rate
     *
     * @return int
     */
    public function getAvgHeartRate()
    {
        return $this->avgHeartRate;
    }

    /**
     * Set max heart rate
     *
     * @param $hr int
     * @return $this
     */
    public function setMaxHeartRate($hr)
    {
        $this->maxHeartRate = $hr;
        return $this;
    }

    /**
     * Get max heart rate
     *
     * @return int
     */
    public function getMaxHeartRate()
    {
        return $this->maxHeartRate;
    }

    /**
     * Set message
     *
     * @param $message string
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set map privacy, it should be const of Privacy class.
     *
     * @param $privacy int
     * @return $this
     */
    public function setMapPrivacy($privacy)
    {
        $this->privacyMap = $privacy;
        return $this;
    }

    /**
     * Get map privacy
     *
     * @return int
     */
    public function getMapPrivacy()
    {
        return $this->privacyMap;
    }

    /**
     * Set workout privacy, it should be const of Privacy class.
     *
     * @param $privacy int
     * @return $this
     */
    public function setWorkoutPrivacy($privacy)
    {
        $this->privacyWorkout = $privacy;
        return $this;
    }

    /**
     * Get workout privacy
     *
     * @return int
     */
    public function getWorkoutPrivacy()
    {
        return $this->privacyWorkout;
    }

    /**
     * Set workout title.
     *
     * @param $title string
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get workout title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set list of hastags
     *
     * @param $hashtags string[]
     * @return $this
     */
    public function setHastags($hashtags)
    {
        $this->hashtags = $hashtags;
        return $this;
    }

    /**
     * Add single hashtag.
     *
     * @param $hashtag string
     * @return $this
     */
    public function addHastag($hashtag)
    {
        $this->hashtags[] = $hashtag;
        return $this;
    }

    /**
     * Have workout hastag?
     *
     * @param $hashtag string
     * @return bool
     */
    public function haveHashtag($hashtag)
    {
        return in_array($hashtag, $this->getHashtags());
    }

    /**
     * Get list of hashtags.
     *
     * @return string[]
     */
    public function getHashtags()
    {
        return $this->hashtags;
    }

    /**
     * Set ascent.
     *
     * @param $ascent float
     * @return $this
     */
    public function setAscent($ascent)
    {
        $this->ascent = $ascent;
        return $this;
    }

    /**
     * Get ascent.
     *
     * @return float
     */
    public function getAscent()
    {
        return $this->ascent;
    }

    /**
     * Set descent.
     *
     * @param $descent float
     * @return $this
     */
    public function setDescent($descent)
    {
        $this->descent = $descent;
        return $this;
    }

    /**
     * Get descent.
     *
     * @return int
     */
    public function getDescent()
    {
        return $this->descent;
    }

    /**
     * Get GPX of workout.
     *
     * @return string
     */
    public function getGPX()
    {
        // @TODO use some library to generate GPX files
        $xml = new \SimpleXMLElement(
            '<gpx xmlns="http://www.topografix.com/GPX/1/1" '
            . 'xmlns:gpxtpx="http://www.garmin.com/xmlschemas/TrackPointExtension/v1" '
            . '/>'
        );
        $trk = $xml->addChild('trk');
        $trk->addChild('type', str_replace(', ', '_', strtoupper($this->getTypeName())));
        $trkseg = $trk->addChild('trkseg');

        foreach ($this->getPoints() as $point) {
            $trkpt = $trkseg->addChild('trkpt');
            $trkpt->addChild('time', $point->getTime()->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d\TH:i:s\Z'));
            $trkpt->addAttribute('lat', $point->getLatitude());
            $trkpt->addAttribute('lon', $point->getLongitude());

            if ($point->getAltitude() !== null) {
                $trkpt->addChild('ele', $point->getAltitude());
            }

            if ($point->getHeartRate() !== null) {
                $ext = $trkpt->addChild('extensions');
                $trackPoint = $ext->addChild('gpxtpx:TrackPointExtension', '', 'gpxtpx');
                $trackPoint->addChild('gpxtpx:hr', $point->getHeartRate(), 'gpxtpx');
            }
        }

        return $xml->asXML();
    }

    /**
     * Set workout Endomondo source
     *
     * @param $source array
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * Get workout Endomondo source
     *
     * @return array
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param $cadece int
     * @return $this
     */
    public function setCadence($cadece)
    {
        $this->cadence = $cadece;
        return $this;
    }

    /**
     * @return int
     */
    public function getCadece()
    {
        return $this->cadence;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return 'Workout "' . $this->getTypeName() . '" was ' . round($this->getDuration() / 60) . 'min long.' . ($this->getDistance() ? (' Distance ' . $this->getDistance() . 'km was achived.') : '') . ' It started at ' . $this->getStart()->format('d.m.Y H:i:s e') . ' and end '. $this->getEnd()->format('d.m.Y H:i:s e') .'.';
    }
}
