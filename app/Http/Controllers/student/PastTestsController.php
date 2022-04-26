<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PastTestsController extends Controller
{
    /**
     * Display all the past tests
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $user = User::where('id','=', Auth::user()->id)->with('tests', function ($query){
            $query->groupBy('test_id');
        })->paginate(5);


        return view('student/past-tests', ['user' => $user]);

    }

    /**
     * Show the test scores for the given test id
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id) {

        $test = Test::where('id', $id)->first();

        $user = User::where('id','=', Auth::user()->id)->with(['tests' => function ($query) use ($id) {
            $query->where('test_id', $id);
        }])->get();

        //dd($user);

        $totalScore = 0;
        $testcount = 0;
        $highestScore = 0;

        foreach($user as $item){
            foreach($item->tests as $test){
                ++$testcount;
                $totalScore += $test->pivot->score;
                if($test->pivot->score > $highestScore){
                    $highestScore = $test->pivot->score;
                }
            }
        }

        $averageScore = $totalScore / $testcount;

        $averageScore = round($averageScore, 2);

        return view('student/past-test-scores', compact('user', 'test', 'averageScore', 'highestScore'));
    }
}
