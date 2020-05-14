<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Instrument;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InstrumentController extends Controller
{
    /**
     * 发送短消息
     */
    public function send_message(Request $request){
       

        $mobile = '13673230727';
       $client  = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers($mobile);
        $sendSms->setSignName('何以');
        $sendSms->setTemplateCode('SMS_113450563');
        $time = date('Y-m-d H:i:s ',time());
        $sendSms->setTemplateParam(['time'=>$time]);
        $sendSms->setOutId('demo'.time());  //发送短信序号
        $rst = $client->execute($sendSms);
        dd($rst);
        if($rst->Message == 'OK'){
            return ['success'=>true];   //短信发送成功
        }else{
            return ['success'=>false];
        }
    }
    public function index(){
        $data = Instrument::paginate(2);
        return view('admin.instrument.index',compact('data'));
    }
    /**
     * 设备添加
     */
    public function add(Request $request){
        if($request->isMethod('get')){
            return view('admin.instrument.add');
        }elseif ($request->isMethod('post')){
            $data = $request->all();
            $file = $request->file('picture');
            if($request->hasFile('picture') && $file->isValid()){
                //获取文件后缀
                $ext = $file->getClientOriginalExtension();
                $dir = date('Y-m-d/');
                $filename = time().'.'.$ext;
                $file->move('./uploads/'.$dir,$filename);
                $data['picture'] = './uploads/'.$dir.$filename;
            }
            unset($data['_token']);
            $res = DB::table('instrument')->insert($data);
            if($res){
                return redirect('admin/instrument/add');
            }else{
                return back()->withInput();
            }
        }
    }

    /**
     * 设备编辑
     */
    public function edit(Request $request){
        if($request->isMethod('get')){
            $id = $request->id;
            $info = Instrument::where('id',$id)->first();
            return view('admin.instrument.edit',compact('info'));
        }elseif ($request->isMethod('post')){
            $id = $request->id;
            $data = $request->all();
            $file = $request->file('picture');
            if($request->hasFile('picture') && $file->isValid()){
                //获取文件后缀
                $ext = $file->getClientOriginalExtension();
                $dir = date('Y-m-d/');
                $filename = time().'.'.$ext;
                $file->move('./uploads/'.$dir,$filename);
                $data['picture'] = './uploads/'.$dir.$filename;
            }
            unset($data['_token']);
            $res = Instrument::where('id',$id)->update($data);
            if($res){
                return redirect('admin/instrument/index');
            }else{
                return back()->withInput();
            }
        }
    }
    /**
     * 设备删除
     */
    public function del(Request $request){
        $id = $request->id;
        $res = Instrument::where('id',$id)->delete();
        if($res){
            return ['info'=>1];
        }else {
            return ['info'=>0];
        }
    }

}
