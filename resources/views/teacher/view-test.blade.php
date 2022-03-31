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
                                @if($questions->count() < 10)
                                    <button type="button" class="btn btn-success float-right inline" data-toggle="modal" data-target="#addQuestionModal">
                                        Add Question
                                    </button>
                                @endif
                                <h2> Total questions for this test: {{$questions->count()}}</h2>
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Answer</th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @if($questions->count())
                                        @foreach($questions as $question)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{$question->description}}</td>
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

                                                    @if($question->answers->count() < 3)
                                                            <button type="button" class="btn btn-success float-right inline" data-toggle="modal" data-target="#addAnswerModal{{$question->id}}">
                                                                Add Answer
                                                            </button>
                                                    @endif
                                                </td>
                                            </tr>
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

    <!-- Add Question Modal -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a Question for this test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teacher-question.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <div class="form-group">
                                <label for="question" class="col-form-label">Question text:</label>
                                <textarea class="form-control" id="question" name="question" placeholder="Write the question here..." required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="type" class="col-form-label">Select the Question type:</label>
                                <select name="type" id="type" class="form-control" size="1" required>
                                    <option value="reading">Reading</option>
                                    <option value="auditory">Auditory</option>
                                    <option value="visual">Visual</option>
                                    <option value="kinesthetic">Kinesthetic</option>
                                </select>
                            </div>

                            <input type="hidden" class="form-control" id="testid" name="testid" value="{{$test->id}}">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add Test</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Answer Modal -->
    <div class="modal fade" id="addAnswerModal{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add an Answer for this Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teacher-answer.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <div class="form-group">
                                <label for="answer" class="col-form-label">Answer text:</label>
                                <input type="text" class="form-control" id="answer" name="answer" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="correct" class="col-form-label">Is this the correct answer?</label>
                                <select name="correct" id="type" class="form-control" size="1" required>
                                    <option value="y">Yes</option>
                                    <option value="n">No</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" class="form-control" id="questionid" name="questionid" value="{{$question->id}}">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add Test</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
