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

    /**
     * @return Model|\Illuminate\Database\Eloquent\Relations\BelongsTo|object|null
     */
    public function taskStatus(){

       return $this->belongsTo(Status::class,'status')->first();
    }

    /**
     * @return Model|\Illuminate\Database\Eloquent\Relations\BelongsTo|object|null
     */

    public function taskPriority(){

       return $this->belongsTo(Priority::class,'priority')->first();
    }

    /**
     * @return Model|\Illuminate\Database\Eloquent\Relations\BelongsTo|object|null
     */
    public function user(){

       return $this->belongsTo(User::class,'user_id')->first();
    }

}
