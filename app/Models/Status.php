<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Ramsey\Collection\Collection;

class Status extends Model
{
    use HasFactory;

    protected $fillable=[
        'slug',
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function tasks(){

        return $this->hasMany(Task::class,'status')->get();
    }

    public function tasksQuery($workspaceId){
        return $this->hasMany(Task::class,'status')->where('workspace',$workspaceId)->get();
    }
}
