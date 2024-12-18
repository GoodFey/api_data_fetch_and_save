<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Income extends Model
{
    protected $table = 'data_incomes';
    protected $guarded = false;

    public static function store(array $data)
    {
        DB::table('data_incomes')->insert($data);
    }

    public static function isExist($data)
    {
        return DB::table('data_incomes')
            ->where('income_id', '=', $data['income_id'])
            ->where('date', '=', $data['date'])
            ->where('nm_id', '=', $data['nm_id'])
            ->where('account_id', '=', $data['account_id'])
            ->exists();
    }

}
