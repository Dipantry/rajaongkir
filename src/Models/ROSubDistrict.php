<?php

namespace Dipantry\Rajaongkir\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int    $id
 * @property string $name
 */
class ROSubDistrict extends Model
{
    protected $table = 'subdistricts';

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->table = config('rajaongkir.table_prefix').'subdistricts';
        parent::__construct($attributes);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(ROCity::class, 'city_id');
    }
}
