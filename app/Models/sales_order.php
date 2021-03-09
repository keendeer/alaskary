<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'total',
        'tax',
        'client_id',
        'employee_id',
        'discount',
    ];

    public function employee()
    {
        return $this->belongsTo(employee::class);
    }

    public function client()
    {
        return $this->belongsTo(client::class);
    }
}
