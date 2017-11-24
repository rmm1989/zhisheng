<?php

namespace App\Http\Controllers\Home;

use App\ClientDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CenterController extends Controller
{
    //平台公告
    public function announcement(Request $request){
        $page = $request->get('page') ? $request->get('page'):2;
        $count = $request->get('count') ? $request->get('count'):2;
        $offset = ($page-1)*$count;
        $announcement = DB::table('announcement')->offset($offset)->limit($count)->get();
        return json_decode($announcement);
        return view('home.i_center.announcement');

    }
    //个人账户详情
    public function account(){
        $openid = 'oB4nYjnoHhuWrPVi2pYLuPjnCaU0';
        $data = ClientDetail::with('instrument')->where('openid',$openid)->get();
        return json_encode($data);

    }
    /**
     * 余额提现
     */
    public function cash(Request $request){

        $openid = "oB4nYjnoHhuWrPVi2pYLuPjnCaU0";
        $cash_amount = $request->get('cash_amount') ? $request->get('cash_amount'):7000;
        $total = DB::table('client_detail')->where('openid',$openid)
                                ->select(DB::raw('cash_pledge + balance as sum'))->first();
        if($total->sum < $cash_amount){
            return '提现金额超过余额总数';
        }else{
            // 待支付接口确定
            dd(json_encode($total));
        }


    }
    //推广记录
    public function record(Request $request){
        $openid = 'oB4nYjnoHhuWrPVi2pYLuPjnCaU0';
        $page = $request->get('page') ? $request->get('page') : 1;
        $count = $request->get('count') ? $request->get('count') : 2;
        $offset = ($page-1)*$count;
        $client = DB::table('client')->where('p_openid',$openid)->offset($offset)->limit($count)->get();
        dd($client);
        return view('home.i_center.record');
    }
    /**
     * 商业合作
     */
    public function cooperation(Request $request){
        if($request->isMethod('get')){
            return view('home.i_center.cooperation');
        }elseif($request->isMethod('post')){
            $info = Input::all();
            unset($info['_token']);
            $res = DB::table('cooperation')->insert($info);
            if($res){
                return "{'message':'您的需求已收到,稍后会有工作人员与您沟通'}";
            }else{
               return "{'message':0}";
            }
        }
    }
    /**
     * 免费申领
     */
    public function free_for(Request $request){
        if($request->isMethod('get')){
            return view('home.i_center.free_for');
        }elseif ($request->isMethod('post')){
            $info = Input::all();
            unset($info['_token']);
            $res = DB::table('free_for')->insert($info);
            if($res){
                return "{'message':'请求已受理,稍后会有工作人员与您联系,请确保通信正常'}";
            }else{
                return "{'message':0}";
            }
        }

    }









    //我的钱包
    public function wallet(){
        return view('home.i_center.wallet');
    }
    //资金流水
    public function money(){
        return view('home.i_center.money');
    }
    //我的订单
    public function self_order(){
        return view('home.i_center.self_order');
    }
    //我的设备
    public function my_device(){
        return view('home.i_center.device');
    }
    //推广赚钱
    public function get_money(){
        return view('home.i_center.get_money');
    }


    //在线客服
    public function online_service(){
        return view('home.i_center.service');
    }


}
