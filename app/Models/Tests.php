<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->hasMany(Questions::class, 'test_id');
    }
}
