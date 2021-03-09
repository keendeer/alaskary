<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee_timeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'total',
    ];

    /*public function employee()
    {
        return $this->hasMany(employee::class);
    }*/
}
