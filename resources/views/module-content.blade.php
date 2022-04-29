<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View a Sub Module: '.$submodule->submodule_name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('module.show', $module->id) }}"><button type="button" class="btn btn-primary float-right">
                            Go Back
                        </button></a>
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">{{ $submodule->submodule_name }}</h3>
                    <br>
                    <p> {{ $submodule->description }}</p>
                </div>
                @include('file-upload-modals')
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight inline">Resources available for this module </h3>
                    @if(Auth::user()->user_type !== "user")
                        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#addFileModal{{Auth::user()->id}}">
                            Add File
                        </button>
                    @endif
                    @if(Auth::user()->user_type == "user")
                        @if($showall == "true")
                            <a href="{{ route('/sub.show', ['submodule' => $submodule->id, 'showall' => 'false', 'module' => $module->id]) }}"><button type="button" class="btn btn-success float-right">
                                    Toggle All: ON
                                </button></a>
                        @else
                            <a href="{{ route('/sub.show', ['submodule' => $submodule->id, 'showall' => 'true', 'module' => $module->id]) }}">
                                <button type="button" class="btn btn-success float-right">
                                    Toggle All: OFF</button></a>
                        @endif
                    <p> PDF and Image files will open in browser, any other type of file will download automatically when clicking view.</p>
                    @endif
                    <div class="grid grid-cols-2 lg:grid-cols-6 hover:grid-cols-6 gap-4">
                        @if($tags->count())
                            @foreach($tags as $tag)
                                @foreach($tag->resources as $file)
                                    @include('file-upload-modals')
                                            <div class="flex items-center justify-center flex-col p-4 rounded-md w-40 space-y-4 bg-blue-300" style="margin: 5px">
                                                <h1 class="text-black">{{ $file->resource_name }}</h1>
                                                <div class="inline-flex">
                                                    <a href="{{ route('file-view',[$file->resource_name, $file->id]) }}" title="View file" style="padding: 5px"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                                    </svg></a>

                                                    <a href="{{ route('file-download',[$file->resource_name, $file->id]) }}" title="Download file" style="padding: 5px"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"></path>
                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"></path>
                                                    </svg></a>
                                                </div>
                                                <div class="inline-flex">
                                                    <h1>Suitable for:</h1>
                                                </div>
                                                <div class="inline-flex">
                                                    @foreach($file->tags as $tag)
                                                        <p style="padding: 3px">{{$tag->tag_name}}</p>
                                                    @endforeach
                                                </div>
                                                <div class="inline-flex">
                                                    @if(Auth::user()->user_type !== "user")
                                                        <div style="padding: 5px">
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editFileModal{{$file->id}}">
                                                                Edit
                                                            </button>
                                                        </div>
                                                        <div style="padding: 5px">
                                                            <form class="inline" action="{{ route('file-delete',$file->id) }}" method="POST">
                                                                @csrf
                                                                @method('POST')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                @endforeach
                            @endforeach
                        @else
                            <div class="flex items-center justify-center flex-col p-4 rounded-md w-30 space-y-4">
                                <p>No files match your learner type, or are currently available, sorry!</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">Tests available for {{$submodule->submodule_name}}</h3>
                    @if($tests->count())
                        @foreach($tests as $test)
                            @if(Auth::user()->user_type === 'user')
                                <a href="{{ route('/user-test.show', $test->id) }}"><h3> {{ $test->test_name }}</h3></a>
                            @elseif(Auth::user()->user_type === 'teacher')
                                <a href="{{ route('/teacher-tests.show', $test->id) }}"><h3> {{ $test->test_name }}</h3></a>
                            @else
                                <h3>{{$test->test_name}}</h3>
                            @endif
                        @endforeach
                    @else
                        <h3> No tests are currently available, sorry!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>
