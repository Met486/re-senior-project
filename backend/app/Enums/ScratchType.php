<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ScratchType extends Enum
{
    const none = 1;
    const little = 2;
    const readable = 3;
    const unreadable = 4;
}
