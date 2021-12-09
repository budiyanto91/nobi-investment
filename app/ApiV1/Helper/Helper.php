<?php
namespace App\ApiV1\Helper;

use App\ApiV1\Nab\Model\NabModel;
use App\ApiV1\User\Model\UserBalanceModel;

class Helper
{
    static function userBalanceUnit($userId)
    {
        $userBalanceUnit = UserBalanceModel::where('user_id', $userId)->first();
        $balanceUnit = $userBalanceUnit ? $userBalanceUnit->total_unit : 0;

        return $balanceUnit;
    }

    static function totalUnit()
    {
        $totalUnit = UserBalanceModel::sum('total_unit');

        return self::roundDown($totalUnit, 4);
    }

    static function currentNab()
    {
        $nabModel = NabModel::latest()->first();
        $nab = $nabModel ? $nabModel->nab : 1;

        return self::roundDown($nab, 4);
    }

    static function roundDown($decimal, $n = 0)
    {
        $roundDown = $decimal;
        $explode = explode('.', strval($decimal));

        if($n > 0 && $explode[0]){
            $strPad = str_pad(1, $n + 1, 0, STR_PAD_RIGHT);
            $precision = intval($strPad);
            $roundDown = floor($decimal * $precision) / $precision;
        }

        return $roundDown;
    }
}