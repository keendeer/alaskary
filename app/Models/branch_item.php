<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class branch_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'item_id',
        'quantity',
    ];


    public function branch()
    {
        return $this->belongsTo(branch::class, 'branch_id');
    }

    public function item()
    {
        return $this->belongsTo(item::class, 'item_id');
    }

}
