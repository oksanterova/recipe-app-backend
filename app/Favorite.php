<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{    
    protected $fillable = array('recipe_label', 'recipe_id', 'recipe_image');
    protected $guarded = ['user_id'];
}
