<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'boxqt',
        'gprice',
        'price',
        'category_id',
    ];


    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function branch_item()
    {
        return $this->hasMany(branch_item::class);
    }


}
