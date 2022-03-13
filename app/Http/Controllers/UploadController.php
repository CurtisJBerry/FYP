<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'file' => 'required',
            'description' => 'required',
            'user' => 'required',
            'name' => 'required',
            'module' => 'required'

        ]);

        $extension = $request->file->extension();
        $path = $request->file('file')->storeAs('public/files', $request->name.".".$extension);


        $resource = new Resource;

        $resource->resource_name = $request->name.".".$extension;
        $resource->resource_path = $path;

        $resource->user_id = $request->user;
        $resource->description = $request->description;
        $resource->module_id = $request->module;
        $resource->save();

        return back()->banner('File added successfully.');

    }

    public function download($name)
    {
        $filepath = storage_path('app/public/files/'.$name);
        //$extension = pathinfo($filepath, PATHINFO_EXTENSION);
        //dd($filepath);
        return response()->download($filepath);

    }

}
