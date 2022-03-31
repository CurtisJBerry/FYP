<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class TeacherQuestionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'type' => 'required',
            'testid' => 'required',

        ]);

        $question = Question::where('description', $request->question)->get();


        if ($question->count()){
            return back()->dangerBanner('A Question with this text already exists, please try again.');
        }else{
            $question= new Question;

            $question->description = $request->question;
            $question->type = $request->type;
            $question->test_id = $request->testid;

            $question->save();


            return back()->banner('Question added successfully.');
        }
    }

}
