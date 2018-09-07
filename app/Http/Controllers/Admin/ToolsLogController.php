<?php

namespace App\Http\Controllers\Admin;

use App\Models\ToolsLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToolsLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.toolslog.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $model = new ToolsLog();
        $res = $request->only(['start_time','end_time','file_name','creator']);
        if (!empty($res)){
            if ($res['creator']){
                $model = $model->where('creator','like',''.$res['creator'].'%');
            }
            if ($res['file_name']){
                $model = $model->where('file_name','like',''.$res['file_name'].'%');
            }
            if ($res['start_time'] && !$res['end_time']){
                $model = $model->where('created_at','>=',$res['start_time']);
            }elseif (!$res['start_time'] && $res['end_time']){
                $model = $model->where('created_at','<=',$res['end_time']);
            }elseif ($res['start_time'] && $res['end_time']){
                $model = $model->whereBetween('created_at',[$res['start_time'],$res['end_time']]);
            }
        }
        $res = $model->orderBy('id','desc')->paginate($request->get('limit',30))->toArray();

        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if (ToolsLog::destroy($ids)){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }

}
