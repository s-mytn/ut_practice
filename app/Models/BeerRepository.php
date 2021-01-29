<?php

namespace App\Models;

use Illuminate\Support\Collection;

interface BeerRepository
{
    public function getAll(): Collection;
}
