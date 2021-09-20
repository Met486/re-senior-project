<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PublishStateType extends Enum
{
    const Private = 0;
    const Public = 1;

    /**
     * Get the description for an enum value
     *
     * @param $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value){
            case self::Private:
                return '非公開';
                brake;
            case self::Public:
                return '公開';
                brake;
            default:
                return self::getKey($value);
        }
    }
}