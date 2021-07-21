<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Plans extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plans::class, 'plan_id');
    }
}
