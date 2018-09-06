<?php

namespace App\Http\Controllers\Admin;

use App\Models\Icon;
use App\Models\OperationLogs;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;


class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 数据表格接口
     */
    public function data(Request $request)
    {
        $model = $request->get('model');
        switch (strtolower($model)) {
            case 'user':
                $query = new User();
                break;
            case 'role':
                $query = new Role();
                break;
            case 'permission':
                $query = new Permission();
                $query = $query->where('parent_id', $request->get('parent_id', 0))->with('icon')->where('display','1');
                break;
            default:
                $query = new User();
                break;
        }
        $res = $query->paginate($request->get('limit', 30))->toArray();
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res['total'],
            'data' => $res['data']
        ];
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * 所有icon图标
     */
    public function icons()
    {
        $icons = Icon::orderBy('sort', 'desc')->get();
        return response()->json(['code' => 0, 'msg' => '请求成功', 'data' => $icons]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logs()
    {
        return view('admin.index.log');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logData(Request $request)
    {
        $keyword = $request->keyword ?? trim($request->keyword);
        $logs = OperationLogs::orderByDesc('operation_logs.created_at')
            ->leftJoin('users', 'users.id', '=', 'user_id')
            ->where(function ($query) use ($keyword) {
                $query->where('route', 'like', '%' . $keyword . '%')
                    ->orWhere('operation_logs.name', 'like', '%' . $keyword . '%')
                    ->orWhere('type', 'like', '%' . $keyword . '%')
                    ->orwhere('users.name', 'like', '%' . $keyword . '%');
            })->select('users.name as user_name','operation_logs.*')
            ->paginate($request->get('limit', 30))
            ->toArray();
        $data = [
            'code' => 0,
            'msg' => '请求成功',
            'data' => $logs['data'],
            'total' => $logs['total']
        ];

        return response()->json($data);
    }

}
