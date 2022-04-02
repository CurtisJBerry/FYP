<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $subjects = Subject::orderBy('subject_name')->paginate(10);

        return view('subjects', ['subjects' => $subjects]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject) {


        $modules = Module::where('subject_id',$subject->id)->paginate(10);

        return view('modules', ['subject' => $subject] , ['modules' => $modules]);

    }

    public function store(Request $request)
    {

        $request->validate([
            'subjectname' => 'required',
            'exam' => 'required',
            'level' => 'required',
            'description' => 'required',

        ]);

        $subject = Subject::where('subject_name', $request->subjectname);

        if ($subject->count()){
            return back()->dangerBanner('A Subject with this name already exists, please try another name.');
        }else{

            $subject = new Subject;

            $subject->subject_name = $request->subjectname;
            $subject->exam_board = $request->exam;
            $subject->subject_level = $request->level;
            $subject->description = $request->description;

            $subject->save();


            return back()->banner('Subject added successfully.');
        }

    }
}
