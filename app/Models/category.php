<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class category extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'category_id',
    ];

    public function mainCategory()
    {

        return $this->hasMany(category::class, 'category_id');

    }

    public function childCategory()
    {

        return $this->belongsTo(category::class, 'category_id');

    }


    public function subCategory()
    {
        return $this->hasMany(category::class)->with('mainCategory');
    }


    public function item()
    {
        return $this->hasMany(item::class);
    }

    public function checkIfSubOrMain($sub, $id)
    {
        if($sub === $id){
            return 'selected';
        }
    }
}
