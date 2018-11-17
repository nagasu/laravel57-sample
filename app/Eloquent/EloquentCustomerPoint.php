<?php
declare(strict_types=1);

namespace App\Eloquent;


use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentCustomerPoint
 * @package App\Eloquent
 * @property int $customer_id
 * @property int $point
 */
final class EloquentCustomerPoint extends Model
{
    protected $table = 'customer_point';

    public $timestamps = false;

    public function addPoint(int $customerId, int $point)
    {
        return $this->newQuery()
                ->where('customer_id', $customerId)
                ->update([
                    $this->getConnection()->raw('point=point+?', $point)
                ]) === 1;
    }

}