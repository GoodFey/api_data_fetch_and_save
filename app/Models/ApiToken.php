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

}