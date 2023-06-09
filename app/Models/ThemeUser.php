<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeUser extends Model
{
    use HasFactory;

    protected $table = 'theme_user';

    protected $fillable = ['user_id','theme_id','role_id'];
}
