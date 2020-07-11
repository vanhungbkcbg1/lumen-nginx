<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $casts=[
        "permissions"=>"array"
    ];

    public function users(){
        return $this->belongsToMany(User::class,"role_users");
    }

    public function hasAccess(array $permissions){
        foreach ($permissions as $permission){
            if($this->hasPermission($permission)){
                return true;
            }
        }
        return  false;
    }

    public function hasPermission(string $permission){
        return $this->permissions[$permission]??false;
    }
}
