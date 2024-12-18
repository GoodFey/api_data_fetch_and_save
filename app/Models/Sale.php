<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    protected $table = 'data_sales';
    protected $guarded = false;
    public static function isExist($data)
    {
        return DB::table('data_sales')
            ->where('income_id', '=', $data['income_id'])
            ->where('nm_id', '=', $data['nm_id'])
            ->where('account_id', '=', $data['account_id'])
            ->where('sale_id', '=', $data['sale_id'])
            ->where('barcode', '=', $data['barcode'])
            ->where('subject', '=', $data['subject'])
            ->exists();
    }
}
