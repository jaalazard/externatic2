<?php

namespace App\Entity;

use App\Service\Localizable;

class JobOfferSearch implements Localizable
{
    private ?string $city = null;

    private ?string $contract = null;

    private ?float $latitude = null;

    private ?float $longitude = null;

    private ?string $search = null;

    private ?int $radius = 500;

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getContract(): ?string
    {
        return $this->contract;
    }

    public function setContract(string $contract): self
    {
        $this->contract = $contract;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLocalization(): ?string
    {
        return $this->getCity();
    }

    public function getRadius(): ?int
    {
        return $this->radius;
    }

    /**
     * Set the value of radius
     */
    public function setRadius(?int $radius): self
    {
        $this->radius = $radius;

        return $this;
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * Set the value of search
     */
    public function setSearch(?string $search): self
    {
        $this->search = $search;

        return $this;
    }
}
