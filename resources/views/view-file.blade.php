<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View a File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ URL::previous() }}"><button type="button" class="btn btn-primary float-right">
                        Go Back
                    </button></a>
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">{{ $name }}</h3>
                </div>

                <div class="p-6 bg-white border-b border-gray-200 flex-box" style="position: relative; width: 100%; overflow: hidden; padding-top: 100%;">
                    <iframe style="position: absolute;top: 0;left: 0;bottom: 0;right: 0;width: 100%;height: 100%;border: none;"  src="{{ asset('storage/files/'.$name) }}"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
