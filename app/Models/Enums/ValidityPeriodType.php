<?php

namespace App\Models\Enums;

enum ValidityPeriodType: string
{

    case Day = "day";
    case Month = "month";
    case Year = "year";
}
