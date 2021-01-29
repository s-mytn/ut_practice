<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Beer extends Model implements BeerRepository
{
    protected $fillable = [
        'name',
    ];

    public function getAll(): Collection
    {
        return $this->all();
    }

    /**
     * 指定のIDでビールを一件取得する
     * 
     * @param int $id
     * @return Book|null
     */
    public function getById(int $id): ?self
    {
        return $this->find($id);
    }

    /**
     * ビールを1件作成する
     * 
     * @param array $attributes
     */
    public function createBeer(array $attributes): self
    {
        return $this->create($attributes);
    }

    /**
     * 
     * @param int $id
     * @param array $attributes
     */
    public function updateById(int $id, array $attributes): void
    {
        $this->find($id)->fill($attributes)->save();
    }

    /**
     * 
     * @param int $id
     */
    public function deleteById(int $id): void
    {
        $this->find($id)->delete();
    }
}
