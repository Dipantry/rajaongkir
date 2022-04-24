<?php

namespace Dipantry\Rajaongkir\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property string $name
 * @property string $type
 * @property string $postal_code
 */
class ROCity extends Model
{
    protected $table = 'cities';

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->table = config('rajaongkir.table_prefix').'cities';
        parent::__construct($attributes);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(ROProvince::class);
    }

    public function subdistricts(): HasMany
    {
        return $this->hasMany(ROSubdistrict::class, 'city_id', 'id');
    }
}
