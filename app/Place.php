<?php

namespace App;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Grimzy\LaravelMysqlSpatial\Types\Point   $location
 * @property \Grimzy\LaravelMysqlSpatial\Types\Polygon $area
 */
class Place extends Model
{
    use SpatialTrait;

    protected $fillable = [
        'name'
    ];

    protected $spatialFields = [
        'location',
        'area'
    ];
}
