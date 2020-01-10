<?php


namespace App\Enums;


class PhasesEnum
{
    const MONOFASICO = 'mono';
    const BIFASICO = 'bi';
    const TRIFASICO = 'tri';

    private static $phases = [
        self::MONOFASICO => 'Monofásico',
        self::BIFASICO => 'Bifásico',
        self::TRIFASICO => 'Trifásico',
    ];

    /**
     * @param $phase
     * @param null $default
     * @return mixed|null
     */
    public static function getPhase($phase, $default = null)
    {
        return array_key_exists($phase, self::$phases) ? self::$phases[$phase] : $default;
    }

    /**
     * @return array
     */
    public static function allPhases()
    {
        return self::$phases;
    }
}
