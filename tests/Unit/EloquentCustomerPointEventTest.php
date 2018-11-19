<?php

namespace Tests\Unit;

use App\Eloquent\EloquentCustomer;
use App\Eloquent\EloquentCustomerPointEvent;
use App\Model\PointEvent;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EloquentCustomerPointEventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function register()
    {
        $customerId = 1;
        factory(EloquentCustomer::class)->create([
            'id' => $customerId
        ]);

        $event = new PointEvent(
            $customerId,
            '加算イベント',
            100,
            Carbon::create(2018, 8, 4, 12, 34, 56)
        );

        $sut = new EloquentCustomerPointEvent();
        $sut->register($event);

        $this->assertDatabaseHas('customer_point_events', [
            'customer_id' => $customerId,
            'event' => $event->getEvent(),
            'point' => $event->getPoint(),
            'created_at' => $event->getCreatedAt(),
        ]);
    }
}
