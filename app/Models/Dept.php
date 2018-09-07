<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    protected $fillable = ['dept_name','dept_code','sort','parent_id'];

    //子分类
    public function childs()
    {
        return $this->hasMany('App\Models\Dept','parent_id','id');
    }

    //所有子类
    public function allChilds()
    {
        return $this->childs()->with('allChilds');
    }

    //部门下所有的帐号
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

}
