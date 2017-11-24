<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
    public function index(){
        $priv_a = DB::table('privilege')->where('garde',1)->get();
        $priv_b = DB::table('privilege')->where('garde',2)->get();
        return view('admin.index.index',compact('priv_a','priv_b'));
    }
    public function welcome(){
        return view('admin.index.welcome');
    }


}
