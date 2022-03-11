<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Resource;
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


        return view('module-content', ['module' => $module, 'files' => $files]);

    }

}
