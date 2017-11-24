<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class IndexController extends Controller{


    public function index(){
        dd(strtotime('21:18'));
//        dd(date('Y-m-d','1513094400'));
        return view('home/index');
    }
    public function info(){
        return view('home/info');
    }


}
?>




