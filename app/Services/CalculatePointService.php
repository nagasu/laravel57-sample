<?php
/**
 * Created by PhpStorm.
 * User: satoshi
 * Date: 2018/11/17
 * Time: 22:13
 */

namespace App\Services;


use App\Exceptions\PreConditionException;

class CalculatePointService
{
    /**
     * @param int $amount
     * @return int
     * @throws PreConditionException
     */
    public static function calcPoint(int $amount): int
    {
        if ($amount < 0) {
            throw new PreConditionException('購入金額が負の数になっています。');
        }

        if ($amount < 1000) {
            return 0;
        }

        if ($amount < 10000) {
            $basePoint = 1;
        } else {
            $basePoint = 2;
        }

        return intval($amount / 100) * $basePoint;
    }
}