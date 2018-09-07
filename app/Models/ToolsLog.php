<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolsLog extends Model
{
    protected $fillable = ['file_name','file_code','secret_type','file_type','print_type','label_type','operate_type','creator'];
}
