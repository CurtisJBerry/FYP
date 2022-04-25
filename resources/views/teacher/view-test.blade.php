<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Test: '.$test->test_name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <div class="p-6 bg-white">
                                <h2 class="inline-flex"> Total questions for this test: {{$questions->count()}} / {{config('global.maxquestions')}}</h2>
                                @if($questions->count() < config('global.maxquestions'))
                                    <button type="button" class="btn btn-success inline-flex" data-toggle="modal" data-target="#addQuestionModal" style="padding-right: 10px">
                                        Add Question
                                    </button>
                                @endif
                                <a href="{{ route('teacher-tests.index') }}"><button type="button" class="btn btn-primary float-right">
                                        Go Back
                                    </button></a>
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Answers</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question Type</th>
                                        <th scope="col" class="relative px-6 py-3"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @if($questions->count())
                                        @foreach($questions as $question)
                                            @include('file-upload-modals')
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    <p>{{$question->description}}</p>
                                                    @if(isset($question->resource->resource_name))
                                                            @if($extension = pathinfo(public_path('/storage/files/'.$question->resource->resource_name), PATHINFO_EXTENSION) == 'mp4')
                                                                <div class="p-6 bg-white border-b border-gray-200">
                                                                    <video preload="auto" width="100%" controls>
                                                                        <source src="{{ asset('storage/files/'.$question->resource->resource_name)}}" type="video/mp4">
                                                                        Your browser does not support the video tag.
                                                                    </video>
                                                                </div>
                                                            @elseif($extension = pathinfo(public_path('/storage/files/'.$question->resource->resource_name), PATHINFO_EXTENSION) == 'jpg' || $extension == 'png')

                                                                <img src="{{ asset('storage/files/'.$question->resource->resource_name) }}" style="width: 60%;height: 200px; margin: 0;padding: 0;border: none;display: block;" alt="Question image">

                                                            @elseif($extension = pathinfo(public_path('/storage/files/'.$question->resource->resource_name), PATHINFO_EXTENSION) == 'mp3')
                                                                <audio controls>
                                                                    <source src="{{ asset('storage/files/'.$question->resource->resource_name) }}" type="audio/mpeg">
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                            @endif
                                                                <button type="button" class="btn btn-primary float-left inline" data-toggle="modal" data-target="#editFileModal{{$question->resource->id}}">
                                                                    Edit
                                                                </button>
                                                                <button type="button" class="btn btn-danger float-left inline" data-toggle="modal" data-target="#deleteFileModal{{$question->resource->id}}">
                                                                    Delete
                                                                </button>
                                                    @else
                                                        <button type="button" class="btn btn-success float-left inline" data-toggle="modal" data-target="#addFileModal{{$question->id}}">
                                                            Add a resource
                                                        </button>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    @foreach($question->answers as $answer)
                                                        @if($answer->correct == "y")
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-flex" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="green" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M5 12l5 5l10 -10"></path>
                                                            </svg>
                                                            <p class="inline-flex">{{$answer->answer_text}}</p>
                                                        @else
                                                            <p>{{$answer->answer_text}}</p>
                                                        @endif
                                                    @endforeach
                                                    @if($question->answers->count() < config('global.maxanswers'))
                                                            <button type="button" class="btn btn-success float-right inline" data-toggle="modal" data-target="#addAnswerModal{{$question->id, $question->answers->count()}}">
                                                                Add Answer
                                                            </button>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    <p>{{$question->type}}</p>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm inline-flex">
                                                    <div style="padding: 5px">
                                                        <a href="{{ route('teacher-question.show', $question->id) }}"><button type="button" class="btn btn-primary">
                                                            Edit</button></a>
                                                    </div>

                                                    <div style="padding: 5px">
                                                        <button type="button" class="btn btn-danger float-right inline" data-toggle="modal" data-target="#deleteQuestionModal{{$question->id}}">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('teacher/test-create-modals')
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">No Questions found!</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
