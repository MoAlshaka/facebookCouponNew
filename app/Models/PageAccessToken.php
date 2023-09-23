<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageAccessToken extends Model
{
    use HasFactory;
    protected $fillable=[
        "user_id","page_name","page_access_token",
    ];
}
