<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Resource;
use App\Models\Subject;
use App\Models\SubModule;
use App\Models\Tag;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Module $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module) {


        $submodules = SubModule::where('module_id',$module->id)->paginate(10);

        $module = Module::where('id', $module->id)->first();

        $subject = Module::with('subject')->where('id', $module->id)->first();

        $subject = $subject->subject->id;

        return view('submodules',compact('module','submodules', 'subject'));

    }


    public function store(Request $request)
    {

        $request->validate([
            'modulename' => 'required',
            'description' => 'required',
            'subject' => 'required',

        ]);

        $module = Module::where('module_name', $request->modulename);

        if ($module->count()){
            return back()->dangerBanner('A Module with this name already exists, please try another name.');
        }else{
            $module = new Module;

            $module->module_name = $request->modulename;
            $module->subject_id = $request->subject;
            $module->description = $request->description;

            $module->save();


            return back()->banner('Module added successfully.');
        }

    }



}
