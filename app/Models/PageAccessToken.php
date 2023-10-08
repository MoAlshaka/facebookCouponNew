<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageAccessToken extends Model
{
    use HasFactory;
    protected $fillable=[
        "account_id","page_id","page_name","page_access_token","user_id",
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
