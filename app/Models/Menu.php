<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = ['name','route','url','permission','parent_id','icon_id','sort'];

    //菜单图标
    public function icon()
    {
        return $this->belongsTo('App\Models\Icon','id','icon_id');
    }
}
