<?php

namespace App\ApiV1\Nab\Model;

use Illuminate\Database\Eloquent\Model;

class NabModel extends Model
{
    protected $table = 'nab';
    protected $fillable = ['total_balance', 'total_unit', 'nab'];
}