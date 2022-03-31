<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class TeacherAnswerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'questionid' => 'required',
            'answer' => 'required',
            'correct' => 'required',

        ]);

        $answer = Answer::where('answer_text', $request->answer)->where('question_id', $request->questionid)->get();


        if ($answer->count()){
            return back()->dangerBanner('An Answer with this text already exists, please try again.');
        }else{
            $answer = new Answer;

            $answer->question_id = $request->questionid;
            $answer->answer_text = $request->answer;
            $answer->correct = $request->correct;

            $answer->save();


            return back()->banner('Answer added successfully.');
        }
    }
}
