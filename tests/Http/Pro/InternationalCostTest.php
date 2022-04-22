<?php

namespace Dipantry\Rajaongkir\Tests\Http\Pro;

use Dipantry\Rajaongkir\Tests\TestCase;
use Dipantry\Rajaongkir\Tests\TestingConfigData;

class InternationalCostTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        TestingConfigData::loadProAPI();
    }


}