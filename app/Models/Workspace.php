<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Workspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
    ];


    public function tasks(){

        return $this->hasMany(Task::class,'workspace');
    }


      public function scopeWorkspaces(Builder $query){

        $query->where('user_id',auth()->user()->id);
     }



}
