<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Manager;
use App\Admin\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ManagerController extends Controller
{

    public function index(){
       /* $info = Manager::paginate(3);*/
        $managers = Manager::with('role')->paginate(3);

        return view('admin.manager.index',compact('managers','info'));
    }
    /**
     * 管理员添加
     */
    public function add(Request $request){
        if ($request->isMethod('get')){
            $roles = Role::get();
            return view('admin.manager.add',compact('roles'));
        }elseif ($request->isMethod('post')){
            $data = Input::get();
            $info['username'] = $data['username'];
            $info['password'] = bcrypt($data['password']);
            $info['phone'] = $data['phone'];
            $info['email'] = $data['email'];
            $info['role_id'] = $data['role_id'];
            $info['remember_token'] = $data['_token'];
            $info['time'] = time();
            $res = DB::table('manager')->insert($info);
            if($res){
                return "1";
            }else{
                return redirect('admin/manager/add')->withInput();
            }
        }

    }

    /**
     * 管理员编辑
     */
    public function edit(Request $request){
        if($request->isMethod('get')){
            $id = $request->id;
            $info = Manager::where('id',$id)->first();
            $roles = Role::get();
            return view('admin.manager.edit',compact('info','roles'));
        }elseif ($request->isMethod('post')){
            $data = Input::get();
            unset($data['_token']);
            unset($data['repass']);
            $data['time'] = time();
            $res = DB::table('manager')->where('id',$data['id'])->update($data);
            if($res){
                return "1";
            }else{
                return redirect('admin/manager/add')->withInput();
            }
        }
    }
    /**
     * 管理员删除
     */
    public function del(Request $request){
        $id = $request->id;
        $res = DB::table('manager')->where('id',$id)->delete();
        if($res){
            return ['info'=>1];
        }else {
            return ['info'=>0];
        }
    }

    public function stop(Request $request){
        $id = $request->id;
        $res = Manager::where('id',$id)->update(['status'=>'0']);
        if($res){
            return ['info'=>1];
        }else {
            return ['info'=>0];
        }
    }
    public function start(Request $request){
        $id = $request->id;
        $res = Manager::where('id',$id)->update(['status'=>'1']);

        if($res){
            return ['info'=>1];
        }else {
            return ['info'=>0];
        }
    }



}
