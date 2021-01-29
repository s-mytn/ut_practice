<?php

namespace Tests\Unit;

use App\Models\Beer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BeerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function 指定のIDでビールを一件取得する()
    {
        $fake = factory(Beer::class)->create();
        $beer = new Beer();
        $actual = $beer->getById($fake->id);

        $this->assertSame($fake->id, $actual->id);

        $actual = $beer->getById(999);

        $this->assertNull($actual);
    }

    /**
     * @test
     */
    public function ビールを1件作成する()
    {
        $beer = new Beer();
        $beer->createBeer(['name' => 'エビス']);
        $actual = Beer::first();

        $this->assertSame('エビス', $actual->name);
    }

    /**
     * @test
     */
    public function 指定のビールを更新する()
    {
        $fake = factory(Beer::class)->create(['name' => 'さっぽろ']);
        $beer = new Beer();
        $beer->updateById($fake->id, ['name' => 'エビス']);
        $actual = Beer::find($fake->id);

        $this->assertSame('エビス', $actual->name);
    }

    /**
     * @test
     */
    public function 指定のビールを削除する()
    {
        $fake = factory(Beer::class)->create();
        $beer = new Beer();
        $beer->deleteById($fake->id);
        $actual = Beer::find($fake->id);

        $this->assertNull($actual);
    }
}
