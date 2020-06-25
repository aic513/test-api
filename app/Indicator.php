<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Indicators
 *
 * @package App
 * @property int $id
 * @property string $value
 * @property string $type
 * @property int $length
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Indicator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Indicator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Indicator query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Indicator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Indicator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Indicator whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Indicator whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Indicator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Indicator whereValue($value)
 * @mixin \Eloquent
 */
class Indicator extends Model
{
    protected $fillable = [
        'value',
        'type',
        'length',
    ];




}
