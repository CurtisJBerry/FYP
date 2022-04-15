<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class LearnerTypeTestController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'row.*.answers' => 'required',
            'row.*.questionid' => 'required',
            'testid' => 'required',
        ]);

        $answers = $request->answers;
        $questions = count($request->questionid);

        $reading = 0;
        $visual = 0;
        $auditory = 0;
        $kinesthetic = 0;

        //for each question, get the answers
        foreach ($request->questionid as $key => $q){

            if (empty($answers[$key])){
                continue;
            }else{
                $a = Answer::where('id', $answers[$key])->first();
                $answertype = $a->type;
            }

            switch ($answertype){

                case 'reading':
                    $reading += 1;
                    break;

                case 'visual':
                    $visual += 1;
                    break;

                case 'auditory':
                    $auditory += 1;
                    break;

                case 'kinesthetic':
                    $kinesthetic += 1;
                    break;
            }
        }

        echo "Reading count:" .$reading . "<br>" . "Visual count:" .$visual . "<br>" . "Auditory count:" .$auditory . "<br>" . "Kinesthetic count:" .$kinesthetic;


//        if (round($score, 2) == 100.0){
//            dd("Full marks");
//        }
//        dd(round($score, 2));
    }
}
