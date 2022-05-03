<?php

namespace App\Http\Controllers\student;

use App\Models\Answer;
use App\Models\Question;
use App\Models\SubModule;
use App\Models\Tag;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class StudentTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $tests = Test::paginate(10);
        $learnertest = Test::where('test_name', "Learner Type")->first();

        //$submodules = SubModule::with('module.subject')->get();

        return view('student/view-all-tests', compact('tests', 'learnertest'));

    }

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


        if(empty($answers)){
            return back()->dangerBanner('You must answer the questions to get a score!');
        }else{

            $score = 0;
            $question_percentage = 100 / $questions;

            $test = Test::find($request->testid);

            //for each question, get the answers
            foreach ($request->questionid as $q){

                $a  = Answer::where('question_id', $q)->where('correct', 'y')->first();

                $data = $a->id;

                if (empty($data)){
                    break;
                }else{

                    foreach ($answers as $key => $val){

                        if ($data == $val){

                            $score += $question_percentage;
                        }
                    }

                }

            }

            $user = Auth::user();

            if (round($score, 2) == 100.0){

                $user->tests()->attach($user->id, ['test_id' => $request->testid, 'score' => 100]);

                return back()->banner('You scored 100%! Keep up the great work!');
            }else{
                $score = (round($score, 2));

                $user->tests()->attach($user->id, ['test_id' => $request->testid, 'score' => $score]);

                return back()->banner('You scored ' . $score . "%. Keep up the good work, your score has been added to your account.");
            }
        }

    }


}
