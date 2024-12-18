<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenType extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'token_types';

    public static function isExist($name)
    {
        return TokenType::where('name', $name)->first() ? true : false;
    }

}
