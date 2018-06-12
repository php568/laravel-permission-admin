<?php

namespace App\Http\Middleware;

use App\Models\OperationLogs;
use App\Models\Permission;
use Closure;
use  Route;

class OperationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (env('OPERATION_LOG')) {
            $this->createOperationLogs($request);
        }

        return $response;
    }


    /**
     * @param $request
     */
    public function createOperationLogs($request)
    {

        $name = [];
        $flag = false;
        $method = $request->method();
        $path = $request->path();
        $route = Route::currentRouteName();
        $permission = Permission::where('route', $route)->first();

        if ($permission) {
            $parent = Permission::where('id', $permission->parent_id)->first();
            if ($parent) {
                $tempParent_id = $parent->parent_id;
                array_push($name,$permission->display_name);
                array_push($name,$parent->display_name);
                $flag = true;
            }
        }

        while ($flag) {
            $tempFlag = Permission::where('id', $tempParent_id)->first();

            if (!$tempFlag) {
                $flag = false;
            } else {
                array_push($name,$tempFlag->display_name);
                $tempParent_id = $tempFlag->parent_id;
            }
        }

        $display_name = '';
        for($i = count($name)-1;$i>=0;$i--){
            $display_name.=$name[$i].'/';
        }
        $name = rtrim($display_name,'/');

        $parameter = $request->except(['_method', '_token']);
        $parameter = count($parameter) ? json_encode($parameter) : '';

        OperationLogs::create([
            'user_id' => auth()->user()->id,
            'route' => $path,
            'name' => $name,
            'type' => $method,
            'parameter' => $parameter
        ]);

    }
}
