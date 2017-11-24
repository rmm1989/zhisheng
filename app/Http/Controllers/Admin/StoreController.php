<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class StoreController extends Controller
{
    public function index(){
        $stores = Store::paginate(2);
        return view('admin.store.index',compact('stores'));
    }
    /**
     * 门店添加
     */
    public function add(Request $request){
        if($request->isMethod('get')){
            $province = DB::table('province')->get();
            return view('admin.store.add',compact('province'));
        }elseif ($request->isMethod('post')){
            $key = "fb3af4600aab3bab7f4cff017f2b9af7";
            $address = Input::get('position')?Input::get('position'):'石家庄市乐汇城';
            $url = "http://restapi.amap.com/v3/geocode/geo?key=".$key."&address=".$address."";
            $ch = curl_init();//初始化curl
            curl_setopt($ch, CURLOPT_URL, $url);//设置url属性
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $result = json_decode(curl_exec($ch));//获取数据
            curl_close($ch);//关闭curl
            $data['store_name']= Input::get('store_name');
            $data['fzr_name']= Input::get('fzr_name');
            $data['phone']= Input::get('phone');
            $data['position']= Input::get('position');
            $data['area_code']= Input::get('area');
            $data['location'] = $result->geocodes[0]->location;
            $data['add_time']= time();
            $res = DB::table('store')->insert($data);
            if($res){
                return ['info'=>1];
            }else{
                return redirect('admin/store/add')->withInput();
            }
        }
    }
    /**
     * 门店删除
     */
    public function del(Request $request){
        $id = $request->id;
        $res = DB::table('store')->where('id',$id)->delete();
        if($res){
            return ['info'=>1];
        }else {
            return ['info'=>0];
        }
    }

    /**
     *门店编辑
     */
    public function edit(Request $request){
        if($request->isMethod('get')){
            $id = $request->id;
            $info = Store::where('id',$id)->first();
            return view('admin.store.edit',compact('info'));
        }elseif ($request->isMethod('post')){
            $id = Input::get('id');
            $data['store_name']= Input::get('store_name');
            $data['fzr_name']= Input::get('fzr_name');
            $data['phone']= Input::get('phone');
            $data['position']= Input::get('position');
            $res = DB::table('store')->where('id',$id)->update($data);
            if($res){
                return "1";
            }else{
                return redirect('admin/store/edit')->withInput();
            }
        }
    }

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
}
