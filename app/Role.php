<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public function users()
    {
        return $this->belongsToMany(User::class,'role_user','user_id','role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    protected $fillable = [
        'name', 'display_name', 'description',
    ];

}
