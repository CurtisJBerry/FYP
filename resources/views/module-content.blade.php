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

                    <p> Resources available for this module </p>

                    @foreach($files as $file)
                        <p>{{ $file->resource_name }}</p>
                        <a href="{{ route('download',$file->resource_name) }}"><button class="btn btn-primary download">Download</button></a>
                    @endforeach

                </div>

                <div class="p-6 bg-white border-b border-gray-200">

                    <p> Add a new file for this module</p>

                    <article style="margin-top: 20px">
                        <h3 class="font-semibold text-xl text-gray-800 leading-tight"></h3>
                        <article>
                            <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    @csrf
                                    <label for="file">Add new file</label>
                                    <input type="file" name="file" id="file" placeholder="Choose file" required>

                                    <label for="description">File name</label>
                                    <input type="text" name="name" required>

                                    <label for="description">File description</label>
                                    <input type="text" name="description" required>

                                    <input type="hidden" name="user" value="{{ Auth::user()->id }}">

                                    <input type="hidden" name="module" value="{{ $module->id }}">

                                    <input type="submit" name="submit" class="btn btn-success" value="Upload File">
                                </div>
                            </form>
                        </article>
                    </article>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
