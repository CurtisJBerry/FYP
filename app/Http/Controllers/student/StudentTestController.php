<?php

namespace App\Http\Controllers\student;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Tag;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StudentTestController extends Controller
{
    /**
     * Display a test with the related questions and answers
     *
     * @param \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = Test::find($id);

        $questions = Question::where('test_id', $id)->with('answers')->get();

        $alltags = Tag::all();

        return view('student/view-test', compact('test', 'questions', 'alltags'));

    }

    public function store(Request $request){

        $request->validate([
            'row.*.answers' => 'required',
            'row.*.questionid' => 'required',
            'testid' => 'required',
        ]);

        $answers = $request->answers;
        $questions = count($request->questionid);

        $score = 0;
        $question_percentage = 100 / $questions;

        $test = Test::find($request->testid);

        //for each question, get the answers
        foreach ($request->questionid as $q){
            $a  = Answer::where('question_id', $q)->where('correct', "y")->first();
            foreach ($answers as $key => $val){
                if ($a->id == $val){
                    $score += $question_percentage;
                }
            }
        }

        if (round($score, 2) == 100.0){
            dd("Full marks");
        }
        dd(round($score, 2));
    }


}
