<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ItemType extends Enum
{
    const selling = 1;
    const in_progress = 2;
    const with_comment = 3;
    const sending = 4;
    const completed = 5;
}
