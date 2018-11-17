<?php

namespace Tests\Unit;

use App\Services\CalculatePointService;
use Tests\TestCase;

class CalculatePointServiceTest extends TestCase
{
    /**
     * @test
     * @throws
     */
    public function calcPoint_購入金額が0ならポイントは0()
    {
        $result = CalculatePointService::calcPoint(0);
        $this->assertSame(0, $result);
    }

    /**
     * @test
     * @throws \App\Exceptions\PreConditionException
     */
    public function calcPoint_購入金額が1000ならポイントは10()
    {
        $result = CalculatePointService::calcPoint(1000);
        $this->assertSame(10, $result);
    }

    /**
     * @test
     * @expectedException \App\Exceptions\PreConditionException
     * @expectedExceptionMessage 購入金額
     */
    public function calcPoint_購入金額が負の数なら例外をスロー()
    {
        CalculatePointService::calcPoint(-1);
    }

    /**
     * @test
     * @dataProvider dataProvider_for_calcPoint
     * @throws \App\Exceptions\PreConditionException
     */
    public function calcPoint(int $expected, int $amount)
    {
        $result = CalculatePointService::calcPoint($amount);
        $this->assertSame($expected, $result);
    }

    public function dataProvider_for_calcPoint()
    {
        return [
            '購入金額が0ならポイントは0' => [0, 0],
            '購入金額が999ならポイントは0' => [0, 999],
            '購入金額が1000ならポイントは10' => [10, 1000],
            '購入金額が9999ならポイントは99' => [99, 9999],
            '購入金額が10000ならポイントは99' => [200, 10000],
        ];
    }
}
