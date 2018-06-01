<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = ['name','route','url','permission','parent_id','icon_id','sort'];

    //对应权限
    public function permission()
    {
        return $this->belongsTo('\Spatie\Permission\Models\Permission','permission_id','id');
    }

    //菜单图标
    public function icon()
    {
        return $this->belongsTo('App\Models\Icon','icon_id','id');
    }

    //子菜单
    public function subMenus()
    {
        return $this->hasMany('App\Models\Menu','parent_id','id');
    }
}
