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
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">Update a Question</h3>
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <div class="col">
                            @if($question->count())
                                @foreach($question as $q)
                                    <form action="{{ route('teacher-question.update', $q->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="question" class="col-form-label">Question Text</label>
                                            <input type="text" class="form-control" name="question" id="question" value="{{$q->description}}" required>
                                        </div>
                                </div>

                                <div class="col">
                                    @foreach($q->answers as $answer)
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="answer[]" class="col-form-label">Answer text</label>
                                                    <input type="text" class="form-control" id="answer[]" name="answers[]" value="{{$answer->answer_text}}" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="correct[]" class="col-form-label">Correct</label>
                                                <input type="text" class="form-control-sm" id="correct[]" name="correct[]" value="{{$answer->correct}}" checked>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success float-right">Submit</button>
                                    </div>
                                </div>
                            </form>

                        @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
