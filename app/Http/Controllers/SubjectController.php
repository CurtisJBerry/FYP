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

        $subjects = Subject::paginate(10);

        return view('subjects', ['subjects' => $subjects]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject) {

        $modules = Subject::find($subject->id)->modules;

        return view('modules', ['subject' => $subject] , ['modules' => $modules]);

    }
}
