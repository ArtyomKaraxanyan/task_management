<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable=[
        'slug',
        'user_id',
        'status',
        'priority',
        'workspace',
        'name',
        'description',
        'project',
        'task_duration',
        'start_date',
        'end_date',
        'task_finish_duration',
        'finish_start_date',
        'finish_end_date'
    ];
    public function workspace(){

        return $this->belongsTo(Workspace::class,'workspace')->first();
    }
    public function taskStatus(){

       return $this->belongsTo(Status::class,'status')->first();
    }

    public function taskPriority(){

       return $this->belongsTo(Priority::class,'priority')->first();
    }
    public function user(){

       return $this->belongsTo(User::class,'user_id')->first();
    }

}
