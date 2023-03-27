<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtasks extends Model
{
    use HasFactory;

    protected $fillable =['name','task_id'];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Tasks::class);
        
    }
}
