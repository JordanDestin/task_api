<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statutes extends Model
{
    use HasFactory;

    protected $filable = ['name'];
    /**
     * Get the task that owns the Statutes
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
