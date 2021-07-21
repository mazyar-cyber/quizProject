<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->hasMany(Questions::class, 'lesson_id');
    }
}
