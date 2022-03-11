<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function create(Request $request)
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

        $resource->resource_name = $request->name;
        $resource->resource_path = $path;

        $resource->user_id = $request->user;
        $resource->description = $request->description;
        $resource->module_id = $request->module;
        $resource->save();

        return back()->banner('File added successfully.');

    }

    public function download($path)
    {

        $filepath = public_path('/public/files/'.$path);
        return response()->download($filepath);

    }

}
