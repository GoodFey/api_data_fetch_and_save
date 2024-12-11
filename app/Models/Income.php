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
}
