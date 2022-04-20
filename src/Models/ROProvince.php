<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 */
class ROProvince extends Model
{
    protected $table = 'provinces';

    public function __construct(array $attributes = [])
    {
        $this->table = config('dipantry.rajaongkir.table_prefix').'provinces';
        parent::__construct($attributes);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(ROCity::class, 'province_id');
    }
}