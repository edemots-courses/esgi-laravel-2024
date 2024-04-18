<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }
}
