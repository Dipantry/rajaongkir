<?php

namespace Dipantry\Rajaongkir\Policies;

use Dipantry\Rajaongkir\Constants\Packages;
use Dipantry\Rajaongkir\Constants\RajaongkirCourier;
use ReflectionException;

class PackagePolicy
{
    private string $package;

    public function __construct(string $package)
    {
        $this->package = $package;
    }

    public function allowGetSupportedCouriers(): bool
    {
        try {
            return Packages::isValidValue($this->package);
        } catch (ReflectionException) {
            return false;
        }
    }

    public function allowGetProvinces(): bool
    {
        try {
            return Packages::isValidValue($this->package);
        } catch (ReflectionException) {
            return false;
        }
    }

    public function allowGetCities(): bool
    {
        try {
            return Packages::isValidValue($this->package);
        } catch (ReflectionException) {
            return false;
        }
    }

    public function allowGetDistricts(): bool
    {
        return $this->package == Packages::PRO;
    }

    public function allowGetCountries(): bool
    {
        return $this->package == Packages::BASIC || $this->package == Packages::PRO;
    }

    public function allowGetCosts(string $courierCode): bool
    {
        if ($this->package == Packages::STARTER) {
            return $courierCode == RajaongkirCourier::JNE ||
                $courierCode == RajaongkirCourier::POS_INDONESIA ||
                $courierCode == RajaongkirCourier::TIKI;
        }

        return $this->package == Packages::BASIC || $this->package == Packages::PRO;
    }

    public function allowGetInternationalOrigin(): bool
    {
        return $this->package == Packages::BASIC || $this->package == Packages::PRO;
    }

    public function allowGetInternationalDestination(): bool
    {
        return $this->package == Packages::BASIC || $this->package == Packages::PRO;
    }

    public function allowGetInternationalCosts(): bool
    {
        return $this->package == Packages::BASIC || $this->package == Packages::PRO;
    }

    public function allowGetCurrencies(): bool
    {
        return $this->package == Packages::BASIC || $this->package == Packages::PRO;
    }

    public function allowGetWaybill(string $courierCode): bool
    {
        if ($this->package == Packages::BASIC) {
            return $courierCode == RajaongkirCourier::JNE;
        }

        return $this->package == Packages::PRO;
    }
}
