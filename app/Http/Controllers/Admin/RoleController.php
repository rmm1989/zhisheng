<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::paginate(3);
        return view('admin.role.index',compact('roles'));
    }
    // 添加角色
    public function add(Request $request){
        if($request->isMethod('get')){
            $priv_a = DB::table('privilege')->where('garde',1)->get();
            $priv_b = DB::table('privilege')->where('garde',2)->get();
            return view('admin.role.add',compact('priv_b','priv_a'));
        }elseif ($request->isMethod('post')){
            $data = Input::all();
            $priv_ids = implode($data['priv_id'],',');
            $info['role_name'] = $data['name'];
            $info['priv_ids'] = $priv_ids;
            $res = DB::table('role')->insert($info);
            if($res){
                $roles = Role::get();
                return view('admin.role.index',compact('roles'));
            }else{
                return redirect('admin/role/add')->withInput();
            }
        }
    }

    public function edit(Request $request){
        $id = $request->id;
        $info = Role::where('id',$id)->first();
        $ids = explode(',',$info->priv_ids);
        $priv_a = DB::table('privilege')->where('garde',1)->get();
        $priv_b = DB::table('privilege')->where('garde',2)->get();
        return view('admin.role.edit',compact('priv_b','priv_a','info','ids'));

    }

    public function del(Request $request){
        $id = $request->id;
        $res = DB::table('role')->where('id',$id)->delete();
        if($res){
            return ['info'=>1];
        }else {
            return ['info'=>0];
        }
    }

}
