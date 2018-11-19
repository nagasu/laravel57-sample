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
final class EloquentCustomer extends Model
{
    protected $table = 'customers';
}