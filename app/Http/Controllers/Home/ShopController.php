<?php

namespace App\Http\Controllers\Home;

use App\Instrument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ShopController extends Controller
{
    public function index(){
        $instruments = Instrument::with('cate')->get();
        $instruments = json_encode($instruments);
        dd($instruments);
        return view('home.shop.index',compact('instruments'));
    }

    //商品详情
    public function detail(Request $request){
        $id = $request->get['id'] ? $request->get['id'] : 1;
        $instrument = Instrument::where('id',$id)->with('cate')->get();
        $instrument = json_encode($instrument);
        dd($instrument);
        return view('home.shop.detail',compact('instrument'));
    }
    //提交收货地址
    public function submit_address(Request $request){
        if($request->isMethod('get')){
            return view('home.shop.submit_address');
        }elseif($request->isMethod('post')){
            $info = Input::all();
//            $data['openid'] = $info['openid'];
            $data['openid'] = 'oB4nYjnoHhuWrPVi2pYLuPjnCaU0';
            $data['name'] = $info['name'];
            $data['phone'] = $info['phone'];
            $data['address'] = $info['address'];
            $res = DB::table('receiving_address')->insert($data);
            dd($res);
            if($res){
                return "{'message':1}";
            }else{
                return "{'message':2}";
            }

        }

    }
    //订单管理
    public function order(Request $request){
        if($request->isMethod('get')){

            $openid = $request->get('openid') ? $request->get('openid') : 'oB4nYjnoHhuWrPVi2pYLuPjnCaU0';
            $id = $request->get('id') ? $request->get('id') :1;
            $address = DB::table('receiving_address')->where('openid',$openid)->get();
            $instruments = DB::table('instrument')->where('id',$id)->get();
            $address = json_encode($address);
            $instruments = json_encode($instruments);
            echo "<pre>";
            var_dump($address);
            dd($instruments);
            return view('home.shop.order',compact('address','instruments'));
        }elseif($request->isMethod('post')){

            $data = Input::all();
        }

    }

    /**
     * 在线支付(待确认)
     */
    public function pay(){

    }

    /**
     * 模糊查询
     */
    public function search(){
        $keyword = Input::get('keyword');
        $instruments = Instrument::where('name','like',$keyword)->get();
        return json_encode($instruments);
    }
}
