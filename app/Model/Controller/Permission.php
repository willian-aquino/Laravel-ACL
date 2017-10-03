<?php

namespace App\Model\Controller;
use App\Model\Controller\Role;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
