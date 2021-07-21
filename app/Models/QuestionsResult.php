<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsResult extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo(Questions::class, 'question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function test()
    {
        return $this->belongsTo(Tests::class, 'test_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Verta::today($value)->format('%B %d، %Y');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Verta::today($value)->format('%B %d، %Y');
    }

}
