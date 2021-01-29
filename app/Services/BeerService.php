<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\BeerRepository;

class BeerService
{

    private $beer;

    public function __construct(BeerRepository $beer)
    {
        $this->beer = $beer;
    }

    public function makeBeerNames(?string $delimiter = '貝'): string
    {
        $beers = $this->beer->getAll();
        return $beers->implode('name', $delimiter);
    }
}
