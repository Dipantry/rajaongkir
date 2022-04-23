<?php /** @noinspection PhpUndefinedClassInspection */

namespace Dipantry\Rajaongkir\Tests;

use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class ServiceTest extends TestCase
{
    use InteractsWithDatabase;

    public function setUp(): void
    {
        parent::setUp();
        TestingConfigData::loadProAPI();
    }

    public function testGetLocalOngkirCost()
    {
        $results = \Rajaongkir::getOngkirCost(1, 200, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($results);
    }

    public function testGetInternationalOngkirCost()
    {
        $results = \Rajaongkir::getInternationalOngkirCost(1, 200, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($results);
    }
}