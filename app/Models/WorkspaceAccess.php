<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkspaceAccess extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'workspace_id'
    ];
    public function workspace()
    {
        return $this->belongsTo(Workspace::class, 'workspace_id');
    }
}
