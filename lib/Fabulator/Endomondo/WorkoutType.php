<?php

namespace Fabulator\Endomondo;

/**
 * Class WorkoutType
 * @package Fabulator\Endomondo
 */
class WorkoutType {
    const RUNNING = 0;
    const CYCLING_TRANSPORT = 1;
    const CYCLING_SPORT = 2;
    const MOUNTAIN_BIKINGS = 3;
    const SKATING = 4;
    const ROLLER_SKIING = 5;
    const SKIING_CROSS_COUNTRY = 6;
    const SKIING_DOWNHILL = 7;
    const SNOWBOARDING = 8;
    const KAYAKING = 9;
    const KITE_SURFING = 10;
    const ROWING = 11;
    const SAILING = 12;
    const WINDSURFING = 13;
    const FINTESS_WALKING = 14;
    const GOLFING = 15;
    const HIKING = 16;
    const ORIENTEERING = 17;
    const WALKING = 18;
    const RIDING = 19;
    const SWIMMING = 20;
    const SPINNING = 21;
    const OTHER = 22;
    const AEROBICS = 23;
    const BADMINTON = 24;
    const BASEBALL = 25;
    const BASKETBALL = 26;
    const BOXING = 27;
    const CLIMBING_STAIRS = 28;
    const CRICKET = 29;
    const ELLIPTICAL_TRAINING = 30;
    const DANCING = 31;
    const FENCING = 32;
    const FOOTBALL_AMERICAN = 33;
    const FOOTBALL_RUGBY = 34;
    const FOOTBALL_SOCCER = 35;
    const HANDBALL = 36;
    const HOCKEY = 37;
    const PILATES = 38;
    const POLO = 39;
    const SCUBA_DIVING = 40;
    const SQUASH = 41;
    const TABLE_TENIS = 42;
    const TENNIS = 43;
    const VOLEYBALL_BEACH = 44;
    const VOLEYBALL_INDOOR = 45;
    const WEIGHT_TRAINING = 46;
    const YOGA = 47;
    const MARTINAL_ARTS = 48;
    const GYMNASTICS = 49;
    const STEP_COUNTER = 50;
    const SKATEBOARDING = 89;
    const CIRKUIT_TRAINING = 87;

    /**
     * @var string[]
     */
    const TYPES_NAMES = [
        self::RUNNING  => 'Running',
        self::CYCLING_TRANSPORT  => 'Cycling, transport',
        self::CYCLING_SPORT  => 'Cycling, sport',
        self::MOUNTAIN_BIKINGS  => 'Mountain biking',
        self::SKATING  => 'Skating',
        self::ROLLER_SKIING  => 'Roller skiing',
        self::SKIING_CROSS_COUNTRY  => 'Skiing, cross country',
        self::SKIING_DOWNHILL  => 'Skiing, downhill',
        self::SNOWBOARDING  => 'Snowboarding',
        self::KAYAKING  => 'Kayaking',
        self::KITE_SURFING => 'Kite surfing',
        self::ROWING => 'Rowing',
        self::SAILING => 'Sailing',
        self::WINDSURFING => 'Windsurfing',
        self::FINTESS_WALKING => 'Fitness walking',
        self::GOLFING => 'Golfing',
        self::HIKING => 'Hiking',
        self::ORIENTEERING => 'Orienteering',
        self::WALKING => 'Walking',
        self::RIDING => 'Riding',
        self::SWIMMING => 'Swimming',
        self::SPINNING => 'Spinning',
        self::OTHER => 'Other',
        self::AEROBICS => 'Aerobics',
        self::BADMINTON => 'Badminton',
        self::BASEBALL => 'Baseball',
        self::BASKETBALL => 'Basketball',
        self::BOXING => 'Boxing',
        self::CLIMBING_STAIRS => 'Climbing stairs',
        self::CRICKET => 'Cricket',
        self::ELLIPTICAL_TRAINING => 'Elliptical training',
        self::DANCING => 'Dancing',
        self::FENCING => 'Fencing',
        self::FOOTBALL_AMERICAN => 'Football, American',
        self::FOOTBALL_RUGBY => 'Football, rugby',
        self::FOOTBALL_SOCCER => 'Football, soccer',
        self::HANDBALL => 'Handball',
        self::HOCKEY => 'Hockey',
        self::PILATES => 'Pilates',
        self::POLO => 'Polo',
        self::SCUBA_DIVING => 'Scuba diving',
        self::SQUASH => 'Squash',
        self::TABLE_TENIS => 'Table tennis',
        self::TENNIS => 'Tennis',
        self::VOLEYBALL_BEACH => 'Volleyball, beach',
        self::VOLEYBALL_INDOOR => 'Volleyball, indoor',
        self::WEIGHT_TRAINING => 'Weight training',
        self::YOGA => 'Yoga',
        self::MARTINAL_ARTS => 'Martial arts',
        self::GYMNASTICS => 'Gymnastics',
        self::STEP_COUNTER => 'Step counter',
        self::CIRKUIT_TRAINING => 'Circuit Training',
        self::SKATEBOARDING => 'Skateboarding',
    ];

    /**
     * Is endomondo workout type defined?
     *
     * @param $id
     * @return bool
     */
    static function exist($id)
    {
        try {
            return (bool) self::getName($id);
        } catch (EndomondoWorkoutException $e) {
            return false;
        }
    }

    /**
     * Get name of workot in human readable time.
     *
     * @param $id int Workout type id
     * @return string Name of workout
     * @throws EndomondoWorkoutException when workout type is not defined
     */
    static function getName($id)
    {
        try {
            return self::TYPES_NAMES[$id];
        } catch (\Exception $e) {
            throw new EndomondoWorkoutException('Unknown workout type', $e->getCode(), $e->getPrevious());
        }
    }
}