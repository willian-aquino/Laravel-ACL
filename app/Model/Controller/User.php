<?php

namespace App\Model\Controller;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Model\Controller\Permission;
use App\Model\Controller\Role;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The method for type of acess, exemple:Manager, Administrador.
     *
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
        
    /**
     * return all permission determinate roler  user in auth.
     */
    public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }
    
    /**
     * return  permission determinate roler  user in auth.
     */
    /*public function hasAnyRoles($roles)
    {
        if(is_array($roles)  || is_object($roles)){
            foreach ($roles as $role){
                return $this->roles->contains('name', $role->name);
            }
        }
        return $this->roles->contains('name', $roles);
    }*/
    public function hasAnyRoles($roles)
    {
        if(is_array($roles)  || is_object($roles)){
            return !! $roles->intersect($this->roles)->count();
        }
        return $this->roles->contains('name', $roles);
    }
}
