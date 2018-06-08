<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.message.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $res = Message::orderBy('id','desc')->paginate($request->get('limit',30))->toArray();
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];
        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function getUser(Request $request)
    {
        if ($request->ajax()){
            //默认后台用户
            $model = new User();
            if ($request->get('user_type')==3){
                $model = new Member();
            }
            $keywords = $request->get('keywords');
            if ($keywords){
                $model = $model->where('name','like','%'.$keywords.'%')->orWhere('phone','like','%'.$keywords.'%');
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
        return view('admin.message.getUser');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.message.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|min:4|max:200',
            'content' => 'required|min:4|max:400'
        ]);
        if (empty($request->get('user'))){
            return back()->withInput()->with(['status'=>'请选择用户']);
        }
        $data = $request->only(['title','content','user']);
        //后台推送给后台用户
        if (isset($data['user'][2]) && !empty($data['user'][2])){
            foreach ($data['user'][2] as $uuid){
                Message::create([
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'send_uuid' => auth()->user()->uuid,
                    'accept_uuid' => $uuid,
                    'flag' => 22
                ]);
            }
        }
        //后台推送给前台用户
        if (isset($data['user'][3]) && !empty($data['user'][3])){
            foreach ($data['user'][3] as $uuid){
                Message::create([
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'send_uuid' => auth()->user()->uuid,
                    'accept_uuid' => $uuid,
                    'flag' => 23
                ]);
            }
        }
        return back()->with(['status'=>'消息推送完成']);
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
    public function destroy($id)
    {
        //
    }
}
