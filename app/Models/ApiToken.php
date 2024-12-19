<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ApiToken extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'api_tokens';

    public static function getTokenByService($apiService)
    {
        return DB::table('api_tokens')
            ->join('token_types', 'api_tokens.token_type_id', '=', 'token_types.id')
            ->where('api_service_id', $apiService)
            ->pluck('token_types.name', 'api_tokens.token_value')
            ->all();
    }

}
