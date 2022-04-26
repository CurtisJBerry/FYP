<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Question') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                        Update a Question
                        <a href="{{ route('/teacher-tests.show', $question->test_id)}}"><button type="button" class="btn btn-primary float-right inline-flex">
                                Go Back
                            </button></a>
                    </h3>
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <div class="col">
                            @if($question->count())
                                    <form action="{{ route('teacher-question.update',$question->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="question" class="col-form-label">Question Text</label>
                                            <input type="text" class="form-control" name="question" id="question" value="{{$question->description}}" required>

                                            <label for="qtype" class="col-form-label">Question Type</label>
                                            <select class="form-control" id="qtype" name="qtype" required>
                                                @if(isset($question->type))
                                                    <option value="{{$question->type}}" hidden selected>{{ucfirst($question->type)}}</option>
                                                    <option value="reading">Reading</option>
                                                    <option value="auditory">Auditory</option>
                                                    <option value="visual">Visual</option>
                                                    <option value="kinesthetic">Kinesthetic</option>
                                                @else
                                                    <option value="reading">Reading</option>
                                                    <option value="auditory">Auditory</option>
                                                    <option value="visual">Visual</option>
                                                    <option value="kinesthetic">Kinesthetic</option>
                                                @endif
                                            </select>

                                        </div>
                        </div>

                                <div class="col">
                                    @foreach($question->answers as $answer)
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="answers[]" class="col-form-label">Answer text</label>
                                                    <input type="text" class="form-control" id="answers[]" name="answers[]" value="{{$answer->answer_text}}" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="correct[]" class="col-form-label">Is this the correct answer?</label>
                                                        <select class="form-control col-span-6 sm:col-span-6 lg:col-span-2" id="correct[]" name="correct[]" required>
                                                            @if($answer->correct == "y")
                                                                <option value="y" selected>Yes</option>
                                                                <option value="n">No</option>
                                                            @else
                                                                <option value="y">Yes</option>
                                                                <option value="n" selected>No</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="type[]" class="col-form-label">Optional: Answer type</label>
                                                        <select class="form-control" id="type[]" name="type[]">
                                                            @if(isset($answer->type))
                                                                <option value="{{$answer->type}}" hidden selected>{{ucfirst($answer->type)}}</option>
                                                                <option value="">No type set</option>
                                                                <option value="reading">Reading</option>
                                                                <option value="auditory">Auditory</option>
                                                                <option value="visual">Visual</option>
                                                                <option value="kinesthetic">Kinesthetic</option>
                                                            @else
                                                                <option value="" selected>No type set</option>
                                                                <option value="reading">Reading</option>
                                                                <option value="auditory">Auditory</option>
                                                                <option value="visual">Visual</option>
                                                                <option value="kinesthetic">Kinesthetic</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success float-right">Submit</button>
                                    </div>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
