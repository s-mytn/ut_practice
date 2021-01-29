<?php

namespace Tests\Unit;

use App\Models\Beer;
use App\Models\BeerRepository;
use App\Services\BeerService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class BeerServiceTest extends TestCase
{
    use RefreshDatabase;
    use MockeryPHPUnitIntegration;

    /**
     * @dataProvider provider
     * @test
     */
    public function 全てのビール名を指定の文字で区切って生成($delimiter, $expected)
    {
        $beers = collect([
            factory(Beer::class)->make(['name' => 'よなよな']),
            factory(Beer::class)->make(['name' => 'ハイネケン']),
            factory(Beer::class)->make(['name' => 'タイガービール']),
        ]);
        
        $mock = \Mockery::mock(BeerRepository::class);
        $mock->shouldReceive('getAll')->andReturn($beers)->getMock();
        
        app()->instance(Beer::class, $mock);

        $service = app()->make(BeerService::class);
        $actual = $service->makeBeerNames($delimiter);

        $this->assertSame($expected, $actual);
    }

    public function provider(): array
    {
        return [
            'スラッシュ' => ['/', 'よなよな/ハイネケン/タイガービール'],
            '点' => ['、', 'よなよな、ハイネケン、タイガービール'],
            'ヌル' => [null, 'よなよなハイネケンタイガービール'],
        ];
    }
}
