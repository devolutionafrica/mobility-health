<?php

namespace App\Models\Enums;

enum Toast: string
{
    case createSuccess = "create_success";
    case createDanger = "create_danger";
    case updateSuccess = "update_success";
    case updateDanger = "update_danger";
    case deleteSuccess = "delete_success";
    case deleteDanger = "delete_danger";
}
