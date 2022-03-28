<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Resource;
use App\Models\Subject;
use App\Models\Tag;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Module $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {

        if (isset(Auth::user()->learner_type) && Auth::user()->user_type != 'admin'){
            //if learner type is set, find resources and tags based on learner type
            $tags = Tag::where('tag_name','=', Auth::user()->learner_type)->with(['resources' => function ($query) use ($module) {
                $query->where('module_id',$module->id);
            }])->get();


        }else{
            //if learner type is not set, get all resources and tags
            $tags = Tag::with(['resources' => function ($query) use ($module) {
                $query->where('module_id',$module->id)->groupBy('resource_id');
            }])->get();


        }


        $tests = Test::where('module_id',$module->id);

        $alltags = Tag::all();

        return view('module-content', ['module' => $module, 'tags' => $tags, 'tests' => $tests, 'alltags' => $alltags]);

    }

    public function store(Request $request)
    {

        $request->validate([
            'modulename' => 'required',
            'description' => 'required',
            'subject' => 'required',

        ]);

        $module = Module::where('module_name', $request->modulename);

        if ($module){
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
