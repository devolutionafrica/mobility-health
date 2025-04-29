<?php

namespace App\Models\Enums;

enum UserType: string
{

    case Admin = "admin";
    case Manager = "manager";
    case ReferentDoctor = "referent-doctor";
    case HealthPartner = "health-partner";
}
