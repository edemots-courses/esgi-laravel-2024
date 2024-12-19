<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieDistributor extends Model
{
    protected $table = 'distributeurs';

    protected $primaryKey = 'id_distributeur';

    public function movies()
    {
        return $this->hasMany(Movie::class, 'id_distributeur');
    }
}
