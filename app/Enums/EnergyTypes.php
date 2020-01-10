<?php


namespace App\Enums;


class EnergyTypes
{
    const RESIDENCIAL = 'residence';
    const INDUSTRIAL = 'industry';
    const RURAL = 'rural';
    const COMERCIAL = 'commercial';
    const PODER_PUB = 'public_power';
    const SERVICO_PUB = 'public_service';
    const ILUMINACAO_PUB = 'public_lighting';

    private static $types = [
        self::RESIDENCIAL => 'Residêncial',
        self::INDUSTRIAL => 'Industrial',
        self::RURAL => 'Rural',
        self::COMERCIAL => 'Comercial',
        self::PODER_PUB => 'Poder publico',
        self::SERVICO_PUB => 'Servico publico',
        self::ILUMINACAO_PUB => 'ILuminucação publico',
    ];

    /**
     * @param $type
     * @param null $default
     * @return mixed|null
     */
    public static function getTypes($type, $default = null)
    {
        return array_key_exists($type, self::$types) ? self::$types[$type] : $default;
    }

    /**
     * @return array
     */
    public static function allTypes()
    {
        return self::$types;
    }
}
