<?php

namespace App;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use SpatialTrait;
    
    protected $table = 'building';
    protected $fillable = [
        'id', 'location', 'fakultas', 'name', 'area', 'coordinate', 'userid_created', 'userid_updated',
    ];

    protected $spatialFields = [
        'area', 'coordinate'
    ];

    public function rAp()
    {
        return $this->hasMany(Ap::class, 'building_id', 'id');
    }
}
