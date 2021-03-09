<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'address',
        'tel',
        'type',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    /*public function mainBranch()
    {

        return $this->hasMany(branch::class, 'branch_id');

    }

    public function childBranch()
    {

        return $this->belongsTo(branch::class, 'branch_id');

    }


    public function subBranch()
    {
        return $this->hasMany(branch::class)->with('mainBranch');
    }

    public function checkIfSubOrMain($sub, $id)
    {
        if($sub === $id){
            return 'selected';
        }
    }*/
}
