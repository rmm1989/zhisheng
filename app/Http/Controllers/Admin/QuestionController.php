<?php

namespace App\Http\Controllers\Admin;

use App\Paper;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{

    public function index(){
            $data = Question::with('paper')->paginate(2);
            return view('admin.question.index',compact('data'));
    }
    public function add(Request $request){
        if($request->isMethod('get')){
            $paper = Paper::all();
            return view('admin.question.add',compact('paper'));
        }
    }
}
