<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountAccessToken extends Model
{
    use HasFactory;

    protected $fillable=[
        "account_access_token","account_id","user_id"
    ];
}
