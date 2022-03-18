<?php

namespace App\Http\Controllers;

use App\Models\Changelog;
use App\Models\Resource;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\NoReturn;

class FileUploadController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'file' => 'required',
            'description' => 'required',
            'user' => 'required',
            'filename' => 'required',
            'module' => 'required'

        ]);

        $extension = $request->file->extension();
        $path = $request->file('file')->storeAs('public/files', $request->filename.".".$extension);


        $resource = new Resource;

        $resource->resource_name = $request->filename.".".$extension;
        $resource->resource_path = $path;

        $resource->user_id = $request->user;
        $resource->description = $request->description;
        $resource->module_id = $request->module;
        $resource->save();

        return back()->banner('File added successfully.');

    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'file',
            'filename' => 'required',
            'description' => 'required',
            'user' => 'required',
            'module' => 'required',

        ]);


        $file = Resource::find($id);
        if($request->file){

            //find and delete existing file
            Storage::disk('public')->delete('/files/'.$file->resource_name);
            $file->delete();

            $extension = $request->file->extension();
            $path = $request->file('file')->storeAs('public/files', $request->filename.".".$extension);


            $resource = new Resource;

            $resource->resource_name = $request->filename.".".$extension;
            $resource->resource_path = $path;

            $resource->user_id = $request->user;
            $resource->description = $request->description;
            $resource->module_id = $request->module;
            $resource->save();



        }else{

            //set new filename, with extension and path
            $extension = $request->file->extension();
            $path = $request->file('file')->storeAs('public/files', $request->filename.".".$extension);

            $file->resource_name = $request->filename.".".$extension;
            $file->resource_path = $path;
            $file->description = $request->description;
            $file->save();
        }

        return back()->banner('File updated successfully.');

    }

    public function download($name, $id)
    {
        $log = new Changelog;
        $log->user_id = Auth::user()->id;
        $log->resource_id = $id;
        $log->save();

        $filepath = storage_path('app/public/files/'.$name);

        return response()->download($filepath);

    }


    public function destroy($resource)
    {

        $toDelete = Resource::find($resource);

        Storage::disk('public')->delete('/files/'.$toDelete->resource_name);

        $toDelete->delete();


        return back()->dangerBanner('File deleted successfully.');

    }

}
