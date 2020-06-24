<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Indicators
 *
 * @package App
 */
class Indicator extends Model
{
    protected $fillable = [
        'value',
        'type',
        'length',
    ];
}
