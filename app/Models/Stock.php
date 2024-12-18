<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stock extends Model
{
    protected $table = 'data_stocks';
    protected $guarded = false;
    public static function isExist($data)
    {
        return DB::table('data_stocks')
            ->where('nm_id', '=', $data['nm_id'])
            ->where('account_id', '=', $data['account_id'])
            ->where('barcode', '=', $data['barcode'])
            ->exists();
    }
}
