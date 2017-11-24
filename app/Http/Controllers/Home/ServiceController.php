<?php

namespace App\Http\Controllers\Home;

use App\ClientDetail;
use App\Maintenance;
use App\ServiceFault;
use App\Store;
use App\ToDoor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ServiceController extends Controller
{
    //预约听力测试
    public function listening_test(Request $request){
        if($request->isMethod('get')){
            $province = DB::table('province')->get();
//            dd($province);
            return view('home.service.listening_test',compact('province'));
        }elseif ($request->isMethod('post')){
//            $data = $request->all();
            $data['name'] = Input::get('name');
            $data['phone'] = Input::get('phone');
            $data['store_id'] = Input::get('store_num');
            $data['reservation_time'] = strtotime(Input::get('reservation_time'));
//            var_dump($data);
            $res = DB::table('reservation')->insert($data);
            if($res){
                return "{'message':1}";
            }else{
                return "{'message':0}";
            }
        }
    }

    /**
     * @param Request $request
     * @return string 获取城市
     */
    public function getCity(Request $request){
        $province_code = $_GET['p_code'];
        $citys = DB::table('city')->where('province_code',$province_code)->get();
        $city = "<option value='0'>请选择市</option>";

        foreach ($citys as $v){
            $city .= "<option value='".$v->code."'>".$v->name."</option>";
        }
        return $city;
    }
    //获取县区
    public function getArea(){
        $c_code = $_GET['c_code'];
        $data = DB::table('area')->where('city_code',$c_code)->get();
        $areas = "<option value='0'>请选择县（区）</option>";
        foreach ($data as $v){
            $areas .= "<option value='".$v->code."'>".$v->name."</option>";
        }
        return $areas;
    }
    //获取门店信息
    public function getStore(){
        $a_code = $_GET['a_code'];
        $data = DB::table('store')->where('area_code',$a_code)->get();
//        $data = json_encode($data);
        $list = '';
        foreach ($data as $v){
            $list .= "<option  value='".$v->id."'>".$v->store_name."</option>";
        }
//        dd($data);
        return $list;
    }


    //预约设备保养
    public function order_maintenance(Request $request,ClientDetail $clientDetail){
        if($request->isMethod('post')){
            $info = Input::all();
            $time = strtotime($info['time']);
            $data['name'] = $info['name'];
            $data['phone'] = $info['phone'];
            $data['time'] = $time;
            $data['store_id'] = $info['store_num'];
            $data['instrument_id'] = $info['instrument'];
            $data['maintenance'] = $info['maintenance'];
            $res = DB::table('maintenance')->insert($data);
            if($res){
                return "{'message':1}";
            }else{
                return "{'message':0}";
            }

        }elseif($request->isMethod('get')){
            $openid = "oB4nYjnoHhuWrPVi2pYLuPjnCaU0";
            $info = DB::table('client_detail')->select('instrument_id')->where('openid',$openid)->get();
            $ids = [];
            foreach ($info as $v){
                $ids[] = $v->instrument_id;
            }
            $instruments = DB::table('instrument')->whereIn('id',$ids)->get();
            if(!$instruments){
                return "{'message':'该功能需要租用设备后才可以使用'}";
            }else{
                $province = DB::table('province')->get();
                return view('home/service/order_maintenance',compact('province','instruments'));
            }

        }

    }
    //预约故障处理
    public function fault_handling(Request $request){
        if($request->isMethod('get')){
            $openid = "oB4nYjnoHhuWrPVi2pYLuPjnCaU0";
            $info = DB::table('client_detail')->select('instrument_id')->where('openid',$openid)->get();
            $ids = [];
            foreach ($info as $v){
                $ids[] = $v->instrument_id;
            }
            $instruments = DB::table('instrument')->whereIn('id',$ids)->get();
            if(!$instruments){
                return "{'message':'该功能需要租用或购买设备后才可以使用'}";
            }else{
                $province = DB::table('province')->get();
                return view('home/service/fault_handling',compact('province','instruments'));
            }
        }elseif($request->isMethod('post')){
            $info = Input::all();
            $time = strtotime($info['time']);
            $data['name'] = $info['name'];
            $data['phone'] = $info['phone'];
            $data['time'] = $time;
            $data['store_id'] = $info['store_num'];
            $data['instrument_id'] = $info['instrument'];
            $data['description'] = $info['failure_description'];
            $res = DB::table('service_fault')->insert($data);
            if($res){
                return "{'message':1}";
            }else{
                return "{'message':0}";
            }
        }

    }
    //预约上门服务
    public function re_service(Request $request){
        if($request->isMethod('get')){
            return view('home/service/re_service');
        }elseif($request->isMethod('post')){
            $info = Input::all();
            $data['name'] = $info['name'];
            $data['phone'] = $info['phone'];
            $data['address'] = $info['address'];
            $data['openid'] = $info['openid'];
            $data['service_content'] = $info['service_content'];
            $data['service_time'] = strtotime($info['service_time']);
            $res = DB::table('to_door')->insert($data);
            if($res){
                return "{'message':1}";
            }else{
                return "{'message',0}";
            }

        }

    }
    //预约服务通知
    public function se_notice(){
        $openid = "oB4nYjnoHhuWrPVi2pYLuPjnCaU0";
        $maintenance = Maintenance::with('store')->where('openid',$openid)->get();
        $to_door = ToDoor::where('openid',$openid)->get();
        $service_fault = ServiceFault::with('store')->where('openid',$openid)->get();
        var_dump(json_encode($maintenance));
        echo "<hr>";
        var_dump(json_encode($to_door));
        echo "<hr>";
        var_dump(json_encode($service_fault));

        return view('home/service/se_notice');
    }

    public function search(){
        $keyword = Input::get('keyword');
        $stores = Store::where('name','like',$keyword)->get();
        return json_encode($stores);
    }

}
