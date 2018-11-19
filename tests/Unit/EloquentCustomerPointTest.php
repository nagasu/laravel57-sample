<?php

namespace Tests\Unit;

use App\Eloquent\EloquentCustomer;
use App\Eloquent\EloquentCustomerPoint;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EloquentCustomerPointTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function addPoint()
    {
        $customerId = 1;
        factory(EloquentCustomer::class)->create([
            'id' => $customerId
        ]);
        factory(EloquentCustomerPoint::class)->create([
            'customer_id' => $customerId,
            'point' => 100
        ]);

        $eloquent = new EloquentCustomerPoint();
        $result = $eloquent->addPoint($customerId, 10);

        $this->assertTrue($result);

        $this->assertDatabaseHas('customer_points', [
            'customer_id' => $customerId,
            'point' => 110
        ]);
    }
}
