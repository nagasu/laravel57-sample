<?php

namespace Tests\Unit;

use App\Eloquent\EloquentCustomerPoint;
use App\Eloquent\EloquentCustomerPointEvent;
use App\Model\PointEvent;
use App\Services\AddPointService;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddPointServiceWithMockTest extends TestCase
{
    use RefreshDatabase;

    private $customerPointEventMock;

    private $customerPointMock;

    protected function setUp()
    {
        parent::setUp();

        $this->customerPointEventMock = new class extends EloquentCustomerPointEvent{
            /** @var PointEvent */
            public $pointEvent;

            public function register(PointEvent $event)
            {
                $this->pointEvent = $event;
            }
        };

        $this->customerPointMock = new class extends EloquentCustomerPoint{
            /** @var int */
            public $customerId;

            /** @var int */
            public $point;

            public function addPoint(int $customerId, int $point)
            {
                $this->customerId = $customerId;
                $this->point = $point;

                return true;
            }
        };
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function add()
    {
        // (2)テスト対象メソッドの実行
        $customerId = 1;
        $event = new PointEvent(
            $customerId,
            '加算イベント',
            10,
            Carbon::create(2018, 8, 12, 34, 56)
        );

        $service = new AddPointService(
            $this->customerPointEventMock,
            $this->customerPointMock
        );
        $service->addPoint($event);

        $this->assertEquals($event, $this->customerPointEventMock->pointEvent);
        $this->assertSame($customerId, $this->customerPointMock->customerId);
        $this->assertSame(10, $this->customerPointMock->point);
    }
}
