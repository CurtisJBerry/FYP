<?php

namespace App\Http\Controllers;

use App\Models\Changelog;
use App\Models\Resource;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;


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

        $resource = Resource::where('resource_name', $request->filename.".".$extension);

        if ($resource->count()) {
            return back()->dangerBanner('A File with this name already exists, please try another name.');
        }else{

            $extension = $request->file->extension();

            $path = $request->file('file')->move(public_path('storage/files'), $request->filename.".".$extension);


            //values set in extracted method
            $resource = $this->getResource($request, $extension, $path);


            foreach($request->tags as $tag){
                $resource->tags()->attach($resource->id, ['tag_id' => $tag]);
            }

            return back()->banner('File added successfully.');

        }


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

            //find and delete existing file in storage
            File::delete(public_path('/storage/files/'.$file->resource_name));

            //delete file model
            $file->delete();

            $extension = $request->file->extension();

            $path = $request->file('file')->move(public_path('storage/files/'), $request->filename.".".$extension);

            //values set in extracted method
            $resource = $this->getResource($request, $extension, $path);

            //remove existing tags
            $resource->tags()->detach();

            //add updated tags
            foreach($request->tags as $tag){
                $resource->tags()->attach($resource->id, ['tag_id' => $tag]);
            }

        }else{

            //set new filename, with extension and path
            $extension = pathinfo($file->resource_name, PATHINFO_EXTENSION);

            //find and edit existing file name
            rename(public_path('storage/files/'.$file->resource_name), public_path('storage/files/'.$request->filename.".".$extension));

            $file->resource_name = $request->filename.".".$extension;
            $file->resource_path = public_path('storage/files/'.$request->filename.".".$extension);

            $file->description = $request->description;
            $file->save();

            //remove existing tags
            $file->tags()->detach();

            //add updated tags
            foreach($request->tags as $tag){
                $file->tags()->attach($file->id, ['tag_id' => $tag]);
            }

        }

        return back()->banner('File updated successfully.');

    }

    public function view($name, $id)
    {

        $log = new Changelog;
        $log->user_id = Auth::user()->id;
        $log->resource_id = $id;
        $log->save();

        $extension = pathinfo(public_path('/storage/files/'.$name), PATHINFO_EXTENSION);

        if (File::exists(public_path('/storage/files/'.$name))){
            return view('view-file', compact('name', 'extension'));
        }else{
            return back()->dangerBanner('File not found!');
        }

    }

    public function download($name, $id)
    {

        $log = new Changelog;
        $log->user_id = Auth::user()->id;
        $log->resource_id = $id;
        $log->save();


        $filepath = public_path('/storage/files/'.$name);

        return response()->download($filepath, $name);

    }


    public function destroy($resource)
    {

        $toDelete = Resource::find($resource);

        File::delete(public_path('/storage/files/'.$toDelete->resource_name));

        $toDelete->delete();


        return back()->dangerBanner('File deleted successfully.');

    }

    /**
     * @param Request $request
     * @param $extension
     * @param $path
     * @return Resource
     */
    public function getResource(Request $request, $extension, $path): Resource
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
