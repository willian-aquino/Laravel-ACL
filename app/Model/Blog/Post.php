<?php

namespace App\Model\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Model\Controller\User;

class Post extends Model
{
    //
    
    public function user()
    {
       return $this->belongsTo(User::class);  
    }
}
