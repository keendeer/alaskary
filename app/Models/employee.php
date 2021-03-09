<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'tel',
        'user_id',
        'desc',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sales_order()
    {
        return $this->hasMany(sales_order::class);
    }

    public function sales_order_today(){
        return $this->sales_order()->whereDate('created_at', Carbon::today());
    }
}
