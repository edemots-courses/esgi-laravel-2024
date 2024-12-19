<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }
}
