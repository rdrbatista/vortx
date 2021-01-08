<?php


namespace App\Services;

use App\Models\AreaCode;

class AreaCodeService
{
    public function getAll()
    {
        return AreaCode::all();
    }
}
