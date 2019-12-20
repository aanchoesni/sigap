<?php

namespace App;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

class Ap extends Model
{
    use SpatialTrait;

    protected $table = 'ap';
    protected $fillable = [
        'id', 'location', 'building_id', 'building', 'name', 'status', 'ip', 'coordinate', 'userid_created', 'userid_updated',
    ];

    protected $spatialFields = [
        'coordinate'
    ];

    public function rBuilding()
    {
        return $this->belongsTo(Building::class, 'building_id', 'id');
    }
}
