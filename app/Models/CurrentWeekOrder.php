<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CurrentWeekOrder extends Model
{
    use HasFactory;

    /**
     * @return Collection
     */
    static function getCurrentWeekOrder(): Collection
    {
        return self::all();
    }
}
