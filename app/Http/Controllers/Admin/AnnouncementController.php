<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
    /**
     * 公告列表
     */
    public function list(){
        $list = Announcement::paginate(3);
        return view('admin.announcement.list',compact('list'));
    }
    /**
     * 添加公告
     */
    public function add(Request $request){
        if($request->isMethod('get')){
            return view('admin.announcement.add');
        }elseif ($request->isMethod('post')){
            $rules = [
                'title' => 'required',
                'content'=> 'required',
                'author'=> 'required',
            ];
            $msg = [
                'title.required' => '公告标题不能为空',
                'content.required' => '公告内容不能为空',
                'author.required' => '发布人不能为空',
            ];
            $validator = Validator::make($request->all(),$rules,$msg);
            if($validator->passes()){

                $data['title'] = Input::get('title');
                $data['content'] = Input::get('content');
                $data['author'] = Input::get('author');
                $data['add_time'] = time();
                $res = DB::table('announcement')->insert($data);
                if($res){
                    return ['info'=>1];
                }else{
                    return back()->withErrors('数据有误');
                }
            }else{
                return back()->withErrors($validator);
            }
        }
    }
    /**
     * 编辑公告
     */
    public function edit(Request $request){
        if($request->isMethod('get')){
            $id = $request->id;
            $info = Announcement::where('id',$id)->first();
            return view('admin.announcement.edit',compact('info'));
        }elseif ($request->isMethod('post')){
            $rules = [
                'title' => 'required',
                'content'=> 'required',
                'author'=> 'required',
            ];
            $msg = [
                'title.required' => '公告标题不能为空',
                'content.required' => '公告内容不能为空',
                'author.required' => '发布人不能为空',
            ];
            $validator = Validator::make($request->all(),$rules,$msg);
            if($validator->passes()){
                $id = Input::get('id');
                $data['title'] = Input::get('title');
                $data['content'] = Input::get('content');
                $data['author'] = Input::get('author');
                $data['add_time'] = time();
                $res = Announcement::where('id',$id)->update($data);
                if($res){
                    return ['info'=>1];
                }else{
                    return back()->withErrors('数据有误');
                }
            }else{
                return back()->withErrors($validator);
            }
        }
    }
    /**
     * 删除公告
     */
    public function del(Request $request){
        $id = $request->id;
        $res = DB::table('announcement')->where('id',$id)->delete();
        if($res){
            return ['info'=>1];
        }else {
            return ['info'=>0];
        }
    }

    /**
     * 公告详情
     */
    public function detail(Request $request){
        $id = $request->id;
        $info = Announcement::where('id',$id)->first();
        return view('admin.announcement.detail',compact('info'));
    }
}
