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
            'row.*.questionid' => 'required',
            'row.*.answers' => 'required',
            'row.*.correct' => 'required',

        ]);

        $answers = $request->answers;
        $correct = $request->correct;
        $questionid = $request->questionid;

        if (count(array_unique($answers, SORT_STRING)) < count($answers)){

            return back()->dangerBanner('Answers cannot have the same text, please try again.');

        }elseif(count(array_keys($correct, "y")) > 1){

            return back()->dangerBanner('An Answer can only have one correct answer, please try again.');
        }

        foreach ($request->answers as $key => $answer){

            $answer = Answer::where('answer_text', $answer)->where('question_id', $questionid[$key])->get();

            if ($answer->count()){
                return back()->dangerBanner('An Answer with this text already exists, please try again.');
            }else{
                $answer = new Answer;

                $answer->question_id = $questionid[$key];
                $answer->answer_text = $answers[$key];
                $answer->correct = $correct[$key];

                $answer->save();
            }
        }

        return back()->banner('Answers added successfully.');
    }
}
