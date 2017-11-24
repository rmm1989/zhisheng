<?php

namespace App\Http\Controllers\Home;

use App\HearingSense;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Paper;

class ListenController extends Controller
{
    //听力自测
    public function listening_test(Request $request,Question $question){
        if($request->isMethod('post')){
            $info = $request->all();
            $page = $request->only('page');
            $offset = ($page-1)*5;
            //根据不同的年龄取出不同的试卷
            $id = DB::table('paper')->select('id')->where('age_group',$info['agerange'])->first();
            $question = Question::offset($offset)
                ->where('paper_id',$id->id)
                ->where('question_cate',$info['question_cate'])
                ->limit(5)->get();
            //将取出的数据转换为json 格式
            $question = json_encode($question);
            dd($question);
            $status = $_SERVER['REDIRECT_STATUS'];
            return view('home/listen/result',compact('question','status'));
        }elseif ($request->isMethod('get')){
            return view('home/listen/listening_test');
        }


    }
    // 测试结果
    public function result(Request $request){
        $score = $request->only('sum_score');
        if($score >= 90){
            $result = '{
                "message":"自测听力轻度受损,请到店内用专业仪器检测",
            }';
        }elseif ($score >=80 && $score <90){
            $result = '{
                "message":"请到店内用专业仪器检测",
            }';
        }elseif ($score <= 80){
            $result = '{
                "message":"经检测听力测试正常",
            }';
        }


    }

    //听力常识
    public function hearing_sense(Request $request){

        $senses = DB::table('hearing_sense')->select('id','name','description','picture')->get();
        $senses = json_encode($senses);
        var_dump($senses);
        return $senses;
        return view('home/listen/hearing_sense',compact('senses'));
    }

    //查看更多
    public function more(Request $request){
        $info = $request->all();
        $senses = HearingSense::offset($info['offset'])
                            ->limit($info['limit'])->get();
        $senses = json_encode($senses);
        dd($senses);
        return $senses;
    }
    //听力常识详情
    public function detail(Request $request){
        $id = $_GET['id'];
        $data = HearingSense::where('id',$id)->get();
        $data = json_encode($data);
        dd($data);
        return $data;

    }
}
