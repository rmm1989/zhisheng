<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ShareController extends Controller
{
    //共享理念
    public function ideas(){
        $data = DB::table('sharing_ideas')->get();
        $data = json_encode($data);
        return $data;
        return view('home.share.ideas');
    }

    //助听设备
    public function hearing_aid(){
        $openid = "oB4nYjnoHhuWrPVi2pYLuPjnCaU0";
        $info = DB::table('client_detail')->select('instrument_id')->where('openid',$openid)->get();
        $ids = [];
        foreach ($info as $v){
            $ids[] = $v->instrument_id;
        }
        $instruments = DB::table('instrument')->whereIn('id',$ids)->get();
        return json_encode($instruments);
        dd(json_encode($instruments));
        return view('home/share/hearing_aid',compact('instruments'));

    }

    //退还设备
    public function return_equipment(Request $request){
        if($request->isMethod('get')){
            $openid = "oB4nYjnoHhuWrPVi2pYLuPjnCaU0";
            $info = DB::table('client_detail')->select('instrument_id')->where('openid',$openid)->get();
            $ids = [];
            foreach ($info as $v){
                $ids[] = $v->instrument_id;
            }

            $instruments = DB::table('instrument')->where('id',$ids)->get();
//        dd($instruments);
            if(!$instruments){
                return "{'message':'该功能需要租用设备后才可以使用'}";
            }else{
                $province = DB::table('province')->get();
                return view('home.share.return_equipment',compact('province','instruments'));
            }
        }elseif($request->isMethod('post')){
            $data = Input::all();
            $list['store_id'] = $data['store_num'];
            $list['instrument_id'] = $data['instrument'];
            $list['reservation_time'] = strtotime($data['reservation_time']);
            $res = DB::table('refundable')->insert($list);
            var_dump($res);
            if($res){
                return "{'message':1}";
            }else{
                return "{'message':0}";
            }
        }
    }

    /**
     * 获取城市及门店的相关信息
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
    //使用常识
    public function common_sense(){
        $info = DB::table('common_sense')
                    ->orderby('release_time','desc')->get();
        return json_encode($info);
        return view('home.share.common_sense');
    }

    //助听联盟图
    public function hearing_map(){

        return view('home.share.hearing_map');
    }
}
