<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    public function test()
    {
        return $this->belongsTo(Tests::class, 'test_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lessons::class,'lesson_id');
    }

}
