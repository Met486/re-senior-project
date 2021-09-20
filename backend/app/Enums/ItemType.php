<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ItemType extends Enum
{
    const selling = 1;
    const completed = 2;
    const in_progress = 3;
}
