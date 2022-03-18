<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View a Module') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">{{ $module->module_name }}</h3>
                    <p> {{ $module->description }}</p>
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight inline">Resources available for this module </h3>
                    @if(Auth::user()->user_type !== "user")
                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#addFileModal{{Auth::user()->id}}">
                        Add File
                    </button>
                    @endif
                    <div class="grid grid-cols-6">
                        @if(!empty($files))
                            @foreach($files as $file)
                                <div class="flex items-center justify-center flex-col p-4 rounded-md w-45 space-y-4">
                                    <h1 class="text-black">{{ $file->resource_name }}</h1>
                                    <a href="{{ route('file-download',[$file->resource_name, $file->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"></path>
                                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"></path>
                                        </svg></a>
                                    @if(Auth::user()->user_type !== "user")
                                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#editFileModal{{$file->id}}">
                                            Edit
                                        </button>

                                        <form class="inline" action="{{ route('file-delete',$file->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center justify-center flex-col p-4 rounded-md w-30 space-y-4">
                                <p>No files are currently available, sorry!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">Tests available for {{$module->module_name}}</h3>
                    @if($tests->isNotEmpty())
                        @foreach($tests as $test)
                            <h3> {{ $test->test_name }}</h3>
                        @endforeach
                    @else
                        <h3> No tests are currently available, sorry!</h3>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="editFileModal{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update a file</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('file-edit',$file->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="file" class="col-form-label">Add new file</label>
                                <input type="file" class="form-control" name="file" id="file" placeholder="Choose file">
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="filename" class="col-form-label">File Name:</label>
                                    <input type="text" class="form-control" id="filename" name="filename" maxlength="20" required value="{{$file->resource_name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="filename" class="col-form-label">Description:</label>
                                <input type="text" class="form-control" id="description" name="description" required value="{{$file->description}}">

                                <input type="hidden" name="user" value="{{ Auth::user()->id }}">

                                <input type="hidden" name="module" value="{{ $module->id }}">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Update File</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <!-- Modal -->
    <div class="modal fade" id="addFileModal{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new file for this module</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('file-upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="file" class="col-form-label">Add new file</label>
                            <input type="file" class="form-control" name="file" id="file" placeholder="Choose file" required>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="filename" class="col-form-label">File Name:</label>
                                <input type="text" class="form-control" id="filename" name="filename" maxlength="20" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="filename" class="col-form-label">Description:</label>
                            <input type="text" class="form-control" id="description" name="description" required>

                            <input type="hidden" name="user" value="{{ Auth::user()->id }}">

                            <input type="hidden" name="module" value="{{ $module->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Upload File</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
