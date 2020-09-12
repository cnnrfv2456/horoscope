<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class horoscope extends Model
{
    protected $table = 'horoscope';
    protected $fillable = [
        'date', 'constellation_name', 'all_score', 'all_description',
        'love_score', 'love_description', 'work_score', 'work_description',
        'fortune_score', 'fortune_description',
    ];
}
