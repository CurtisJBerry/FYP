<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Resource;
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

        if (isset(Auth::user()->learner_type)){
            //if learner type is set, find resources and tags based on learner type
            $files = Module::where('id',$module->id)->with(['resource.tags' => function ($query){
                $query->where('tag_name','=', Auth::user()->learner_type);
            }])->get();
            
        }else{

            //if learner type is not set, get all resources and tags
            $files = Module::where('id',$module->id)->with('resource.tags')->get();
        }


        $tests = Module::find($module->id)->test;

        $tags = Tag::all();

        return view('module-content', ['module' => $module, 'files' => $files, 'tests' => $tests, 'tags' => $tags]);

    }

}
