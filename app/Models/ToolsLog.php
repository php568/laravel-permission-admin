<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolsLog extends Model
{
    protected $fillable = ['file_name','file_code','secret_type','file_type','print_type','label_type','operate_type','creator'];

    /**
     * 查询用户的时候name字段处理
     *
     * @author Eric
     * @param $value
     * @return string
     */
    public function getOperateTypeAttribute($value)
    {
        $op = array(
            0 => '无',
            1 => '添加',
            2 => '修改',
            3 => '发送',
        );
        return $op[$value];
    }

}
