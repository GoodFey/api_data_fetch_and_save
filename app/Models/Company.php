<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'companies';

    public static function isExist($name)
    {
        return Company::where('name', $name)->first() ? true : false;
    }

    public static function getCompanyByName($name)
    {
        return Company::where('name', $name)->first();
    }
}
