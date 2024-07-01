<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieType extends Model
{
    protected $table = 'genres';

    protected $primaryKey = 'id_genre';
}
