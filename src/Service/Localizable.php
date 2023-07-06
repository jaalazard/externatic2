<?php

namespace App\Service;

interface Localizable
{
    public function getLocalization(): ?string;
    public function getLongitude(): ?float;
    public function getLatitude(): ?float;
}
