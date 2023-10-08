<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cookie extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','value','user_id'
    ];

    // Mutator for the "value" attribute
    public function setValueAttribute($value)
    {
        // Remove newline characters ("\n") from the value
        $this->attributes['value'] = str_replace("\n", '', $value);
    }

    // Accessor for the "value" attribute
    public function getValueAttribute($value)
    {
        // Remove newline characters ("\n") from the value when retrieving
        return str_replace("\n", '', $value);
    }
}
