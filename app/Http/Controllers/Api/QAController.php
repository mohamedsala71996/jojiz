<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\User\QA;
use Illuminate\Http\Request;

class QAController extends Controller
{
    public function list()
    {
        $qa = QA::with('reply','user','admin')->where('type','question')->where('from','user')->get();
        return ApiResponse::list('QA List', $qa);
    }

    public function question(Request $request){
        $qa = new QA();
        $qa->user_id = $request->user_id;
        $qa->admin_id = 1;
        $qa->product_id = $request->product_id;
        $qa->type = 'question';
        $qa->from = 'user';
        $qa->question = $request->question;
        $qa->save();
        return ApiResponse::created( 'Question Created Successfully',$qa);
    }

    public function requestion(Request $request){
        $qa = new QA();
        $qa->user_id = $request->user_id;
        $qa->qna_id = $request->question_id;
        $qa->admin_id = 1;
        $qa->product_id = $request->product_id;
        $qa->type = 'question';
        $qa->from = 'user';
        $qa->question = $request->question;
        $qa->save();
        return ApiResponse::created( 'Re-Question Created Successfully',$qa);
    }
    public function answer(Request $request){
        $qa = new QA();
        $qa->admin_id = $request->admin_id;
        $qa->type = 'answer';
        $qa->qna_id = $request->question_id;
        $qa->from = 'admin';
        $qa->answer = $request->answer;
        $qa->product_id = $request->product_id;
        $qa->save();
        return ApiResponse::created( 'Answer Created Successfully',$qa);
    }

}
