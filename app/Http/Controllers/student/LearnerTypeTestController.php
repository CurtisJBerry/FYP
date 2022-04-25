<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Tag;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LearnerTypeTestController extends Controller
{

    /**
     * Display a test with the related questions and answers
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = Test::find($id);

        $questions = Question::where('test_id', $id)->with('answers')->get();

        $alltags = Tag::all();

        return view('student/view-learner-test', compact('test', 'questions', 'alltags'));

    }

    /**
     * Check the learner type test results and return the value to the user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

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

        $question_percentage = 100 / $questions;

        if (empty($answers)) {
            return back()->dangerBanner('You must answer the questions to get a learner type suggestion.');
        } else {

            //for each question, get the answers
            foreach ($answers as $key => $q) {

                if (empty($q)) {
                    continue;
                } else {
                    $a = Answer::where('id', $q)->first();
                    $answertype = $a->type;
                }

                switch ($answertype) {

                    case 'reading':
                        $reading += $question_percentage;
                        break;

                    case 'visual':
                        $visual += $question_percentage;
                        break;

                    case 'auditory':
                        $auditory += $question_percentage;
                        break;

                    case 'kinesthetic':
                        $kinesthetic += $question_percentage;
                        break;
                }
            }


            $array = array("Reading" => $reading, "Visual" => $visual, "Auditory" => $auditory, "Kinesthetic" => $kinesthetic);

            $maxIndex = array_search(max($array), $array);

            if (count(array_unique($array)) == 2) {
                return back()->dangerBanner('We couldn\'t determine your learner type as there were matching values! Please try again.');
            } else {

                return redirect()->route('user.dashboard')->with('status', $maxIndex);
            }

        }
    }

    /**
     * Update the users learner type based on the given parameter
     *
     * @return mixed
     */
    public function update(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        $user = User::where('id',Auth::user()->id)->first();

        if (empty($user)){
            return back()->dangerBanner('Your account could not be found!');
        }else{

            if ($user->learner_type !== strtolower($request->type)) {

                $user->learner_type = strtolower($request->type);

                $user->save();

            }
            return back()->banner('Your Learner Type has been updated to ' . $request->type . ".");

        }
    }
}
