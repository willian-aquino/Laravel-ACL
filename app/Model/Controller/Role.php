<?php

namespace App\Model\Controller;

use Illuminate\Database\Eloquent\Model;
use App\Model\Controller\Permission;
class Role extends Model
{
    //
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
