<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiService extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'api_services';

    public static function isExist($name)
    {
        return ApiService::where('name', $name)->first() ? true : false;
    }

}
