<?php

namespace Dipantry\Rajaongkir\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property int    $id
 * @property string $name
 */
class ROProvince extends Model
{
    protected $table = 'provinces';

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->table = config('rajaongkir.table_prefix').'provinces';
        parent::__construct($attributes);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(ROCity::class, 'province_id', 'id');
    }

    public function subDistricts(): HasManyThrough
    {
        return $this->hasManyThrough(
            ROSubDistrict::class,
            ROCity::class,
            'province_id',
            'city_id',
            'id',
            'id'
        );
    }
}
