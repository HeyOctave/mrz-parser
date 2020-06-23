<?php

namespace Deft\MrzParser\Document;

class VehicleRegistrationDocument implements DocumentInterface
{
    protected ?string $issuingCountry = null;
    protected ?string $registrationNumber = null;
    protected ?string $vehicleNumber = null;

    /**
     * @param $fields
     */
    public function __construct($fields)
    {
        foreach ($fields as $fieldName => $value) {
            $this->{$fieldName} = $value;
        }
    }

    public function getIssuingCountry(): string
    {
        return $this->issuingCountry;
    }

    public function setIssuingCountry(string $issuingCountry): void
    {
        $this->issuingCountry = $issuingCountry;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function setRegistrationNumber(string $registrationNumber): void
    {
        $this->registrationNumber = $registrationNumber;
    }

    public function getVehicleNumber(): string
    {
        return $this->vehicleNumber;
    }

    public function setVehicleNumber(string $vehicleNumber): void
    {
        $this->vehicleNumber = $vehicleNumber;
    }
}
