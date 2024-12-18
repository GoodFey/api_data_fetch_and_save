<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Account extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'accounts';

    public static function isExist($name)
    {
        return Account::where('name', $name)->first() ? true : false;
    }

    public static function store($data)
    {
        $company = Company::getCompanyByName($data['company']);

        DB::table('accounts')->insert([
            'name' => $data['name'],
            'company_id' => $company->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
