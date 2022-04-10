<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\SubModule;
use App\Models\Tag;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SubModuleController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Models\SubModule $submodule
     * @param string $showall
     * @return \Illuminate\Http\Response
     */
    public function show(SubModule $submodule, string $showall)
    {

        if ($showall == "false"){
            if (isset(Auth::user()->learner_type) && Auth::user()->user_type != 'admin'){
                //if learner type is set, find resources and tags based on learner type
                $tags = Tag::where('tag_name','=', Auth::user()->learner_type)->with(['resources' => function ($query) use ($submodule) {
                    $query->where('submodule_id', $submodule->id);
                }])->get();

//            foreach ($tags as $tag){
//                if (isEmpty($tag->resource)){
//                    //if learner type is set, but no resources have matching tags, returns error message to user
//                    $tags = collect();
//                }
//            }

            }else {
                //if learner type is not set, get all resources and tags
                $tags = Tag::with(['resources' => function ($query) use ($submodule) {
                    $query->where('submodule_id',$submodule->id)->groupBy('resource_id');
                }])->get();


            }
        } else {

            //show all is set to true
            $tags = Tag::with(['resources' => function ($query) use ($submodule) {
                $query->where('submodule_id',$submodule->id)->groupBy('resource_id');
            }])->get();
        }


        $tests = Test::where('submodule_id',$submodule->id)->get();

        $alltags = Tag::all();

        return view('module-content', ['submodule' => $submodule, 'tags' => $tags, 'tests' => $tests, 'alltags' => $alltags, 'showall' => $showall]);

    }


    public function store(Request $request)
    {

        $request->validate([
            'submodulename' => 'required',
            'description' => 'required',
            'module' => 'required',

        ]);

        $submodule = SubModule::where('submodule_name', $request->submodulename);

        if ($submodule->count()){
            return back()->dangerBanner('A Sub Module with this name already exists, please try another name.');
        }else{
            $submodule = new SubModule;

            $submodule->submodule_name = $request->submodulename;
            $submodule->module_id = $request->module;
            $submodule->description = $request->description;

            $submodule->save();


            return back()->banner('Sub Module added successfully.');
        }

    }
}
