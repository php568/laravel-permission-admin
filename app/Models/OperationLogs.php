<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperationLogs extends Model
{
    protected $table='operation_logs';
    protected $fillable = ['user_id','route','name','type','parameter'];

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
