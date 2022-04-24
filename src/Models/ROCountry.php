<?php

namespace Dipantry\Rajaongkir\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property string $name
 */
class ROCountry extends Model
{
    protected $table = 'countries';

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->table = config('rajaongkir.table_prefix').'countries';
        parent::__construct($attributes);
    }
}
