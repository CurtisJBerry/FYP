<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Question;
use App\Models\SubModule;
use App\Models\Tag;
use App\Models\Test;
use Illuminate\Http\Request;

class TeacherTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $tests = Test::paginate(10);
        $submodules = SubModule::with('module.subject')->get();

        return view('teacher/view-all-tests', compact('tests','submodules'));

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

        return view('teacher/view-test', compact('test', 'questions', 'alltags'));

    }

    public function store(Request $request)
    {

        $request->validate([
            'testname' => 'required',
            'submodule' => 'required',

        ]);

        $test = Test::where('test_name', $request->testname)->get();


        if ($test->count()){
            return back()->dangerBanner('A Test with this name already exists, please try another name.');
        }else{
            $test = new Test;

            $test->test_name = $request->testname;
            $test->submodule_id = $request->submodule;

            $test->save();


            return back()->banner('Test added successfully.');
        }

    }
}
