<?php

namespace Dipantry\Rajaongkir;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Facade extends BaseFacade
{
    protected static function getFacadeAccessor(): string
    {
        return 'rajaongkir';
    }
}
