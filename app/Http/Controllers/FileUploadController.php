<?php

namespace App\Http\Controllers;

use App\Models\Changelog;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class FileUploadController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'file' => 'required',
            'description' => 'required',
            'user' => 'required',
            'filename' => 'required',
            'submodule' => 'required',
            'tags' => 'required',

        ]);


        $extension = $request->file->extension();
        $path = $request->file('file')->storeAs('files/', $request->filename.".".$extension, 'public');

        //values set in extracted method
        $resource = $this->getResource($request, $extension, $path);


        foreach($request->tags as $tag){
            $resource->tags()->attach($resource->id, ['tag_id' => $tag]);
        }

        return back()->banner('File added successfully.');

    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'file',
            'filename' => 'required',
            'description' => 'required',
            'user' => 'required',
            'submodule' => 'required',
            'tags' => 'required',

        ]);


        $file = Resource::find($id);
        if($request->file){

            //find and delete existing file
            Storage::disk('public')->delete('/files/'.$file->resource_name);
            $file->delete();

            $extension = $request->file->extension();
            $path = $request->file('file')->storeAs('public/files/', $request->filename.".".$extension);

            //values set in extracted method
            $resource = $this->getResource($request, $extension, $path);

        }else{

            //set new filename, with extension and path
            $extension = pathinfo($file->resource_name, PATHINFO_EXTENSION);

            //find and edit existing file name
            Storage::move('public/files/'.$file->resource_name, 'public/files/'.$request->filename.".".$extension);

            $file->resource_name = $request->filename.".".$extension;
            $file->resource_path = 'public/files/'.$request->filename.".".$extension;

            $file->description = $request->description;
            $file->save();
        }

        //remove existing tags
        $file->tags()->detach();

        //add updated tags
        foreach($request->tags as $tag){
            $file->tags()->attach($file->id, ['tag_id' => $tag]);
        }

        return back()->banner('File updated successfully.');

    }

    public function view($name, $id)
    {

        $log = new Changelog;
        $log->user_id = Auth::user()->id;
        $log->resource_id = $id;
        $log->save();



        //$filepath = storage_path('app/public/files/'.$name);

        return view('view-file', compact('name'));

    }



    public function download($name, $id)
    {

        $log = new Changelog;
        $log->user_id = Auth::user()->id;
        $log->resource_id = $id;
        $log->save();


        $filepath = storage_path('app/public/files/'.$name);

        return response()->download($filepath, $name);

    }


    public function destroy($resource)
    {

        $toDelete = Resource::find($resource);

        Storage::disk('public')->delete('/files/'.$toDelete->resource_name);

        $toDelete->delete();


        return back()->dangerBanner('File deleted successfully.');

    }

    /**
     * @param Request $request
     * @param $extension
     * @param bool|string $path
     * @return Resource
     */
    public function getResource(Request $request, $extension, bool|string $path): Resource
    {
        $resource = new Resource;


        $resource->resource_name = $request->filename . "." . $extension;
        $resource->resource_path = $path;

        $resource->user_id = $request->user;
        $resource->description = $request->description;
        $resource->submodule_id = $request->submodule;
        $resource->save();

        return $resource;
    }

}
