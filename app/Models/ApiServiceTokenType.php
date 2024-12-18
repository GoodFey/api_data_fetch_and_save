<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ApiServiceTokenType extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'api_service_token_types';

    public static function isTokenAllowedForService($token_type, $api_service)
    {
        return $table = DB::table('api_service_token_types')
            ->where('api_service_id', '=', $api_service)
            ->where('token_type_id', '=', $token_type)
            ->exists();

    }
}
