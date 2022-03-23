<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Resource;
use App\Models\Tag;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $files = Module::find($module->id)->resource;

        $tests = Module::find($module->id)->test;

        $tags = Tag::all();

        return view('module-content', ['module' => $module, 'files' => $files, 'tests' => $tests, 'tags' => $tags]);

    }

}
