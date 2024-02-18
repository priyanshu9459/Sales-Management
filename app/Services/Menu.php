<?php
namespace App\Services;

use App\Permission;
use App\User;
use Illuminate\Support\Facades\DB;

class Menu
{

    public $parent_menus;
    public $sub_menus;

    public function __construct()
    {
//        $arr = [1, 2, 9, 10, 18, 19, 24, 25, 26];
        $roles  = User::find(1)->roles();
        $perms = $roles->first()->permissions;
        $this->parent_menus = Permission::with(implode('.', array_fill(0, 4, 'children')))
            ->where('parent_id', '=', '#')
            ->whereIn('id',$perms->pluck('id'))->get();
        for($i=0; $i<count($this->parent_menus); $i++){
            $this->sub_menus[$i] = $this->parent_menus[$i]->children->wherein('id',$perms->pluck('id'));
        }
//        dd($this);
    }
}
