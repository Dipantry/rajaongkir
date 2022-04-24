<?php

namespace Dipantry\Rajaongkir\Policies;

use Dipantry\Rajaongkir\Models\RajaongkirCourier;

class PackagePolicy
{
    private string $package;

    public function __construct(string $package)
    {
        $this->package = $package;
    }

    public function allowGetSupportedCouriers(): bool
    {
        return $this->package != null;
    }

    public function allowGetProvinces(): bool
    {
        return $this->package != null;
    }

    public function allowGetCities(): bool
    {
        return $this->package != null;
    }

    public function allowGetDistricts(): bool
    {
        return $this->package == 'pro';
    }

    public function allowGetCountries(): bool
    {
        return $this->package == 'basic' || $this->package == 'pro';
    }

    public function allowGetCosts(string $courierCode): bool
    {
        if ($this->package == 'starter') {
            return $courierCode == 'jne' || $courierCode == 'pos' || $courierCode == 'tiki';
        }

        return $this->package == 'basic' || $this->package == 'pro';
    }

    public function allowGetInternationalOrigin(): bool
    {
        return $this->package == 'basic' || $this->package == 'pro';
    }

    public function allowGetInternationalDestination(): bool
    {
        return $this->package == 'basic' || $this->package == 'pro';
    }

    public function allowGetInternationalCosts(): bool
    {
        return $this->package == 'basic' || $this->package == 'pro';
    }

    public function allowGetCurrencies(): bool
    {
        return $this->package == 'basic' || $this->package == 'pro';
    }

    public function allowGetWaybill(string $courierCode): bool
    {
        if ($this->package == 'basic') {
            return $courierCode == RajaongkirCourier::JNE;
        }

        return $this->package == 'pro';
    }
}
