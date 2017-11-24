<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Privilege;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PrivilegeController extends Controller
{
    /**
     * 添加权限路由
     */
    public function add(Request $request){
        if($request->isMethod('get')){
            $privilege = DB::table('privilege')->where('garde',1)->get();
            return view('admin.privilege.add',compact('privilege'));
        }elseif ($request->isMethod('post')){
            $data = Input::all();
            unset($data['_token']);
            $res = DB::table('privilege')->insert($data);
            if($res){
                return ['info'=>1];
            }else{
                return false;
            }
        }
    }
    /**
     * 权限列表
     */
    public function index(Request $request){
        $privilege = DB::table('privilege')->get()->toArray();
        $privilege = getformat($privilege);
        return view('admin.privilege.index',compact('privilege'));
    }
    public function edit(Request $request){
        if($request->isMethod('get')){
            $id = $request->id;
            $info = Privilege::where('id',$id)->first();
            $privilege = DB::table('privilege')->where('garde',1)->get();
            return view('admin.privilege.edit',compact('info','privilege'));
        }elseif ($request->isMethod('post')){
            $id = Input::get('id');
//            dd($id);
            $data = Input::all();
            unset($data['_token']);
            unset($data['id']);
            $res = DB::table('privilege')->where('id',$id)->update($data);
            if($res){
                return "1";
            }else{
                return false;
            }
        }
    }
    public function del(Request $request){
        $id = $request->id;
        $res = DB::table('privilege')->where('id',$id)->delete();
        if($res){
            return ['info'=>1];
        }else {
            return ['info'=>0];
        }
    }


}
