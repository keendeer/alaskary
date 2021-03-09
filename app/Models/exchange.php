<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock',
        'branch',
        'item_id',
        'quantity',
        'process',
    ];

    public function getBranch()
    {
        return $this->belongsTo(branch::class, 'branch');
    }

    public function getStock()
    {
        return $this->belongsTo(branch::class, 'stock');
    }

    public function item()
    {
        return $this->belongsTo(item::class, 'item_id');
    }
}
