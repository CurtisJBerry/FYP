<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Test: '.$test->test_name) }}
        </h2>
    </x-slot>

    <style>
        * {
            box-sizing: border-box;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 50%;
            padding: 10px;
            height: 300px; /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <div class="p-6 bg-white">
                                <h2> Total questions for this test: {{$questions->count()}} / {{config('global.maxquestions')}}</h2>
                                <form action="{{ route('user-test.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    @if($questions->count())
                                        @foreach($questions as $question)
                                            <div class="row">
                                                <div class="column">
                                                    <h2>{{$question->description}}</h2>
                                                    <input type="hidden" value="{{$question->id}}" name="questionid[]">
                                                    @if(isset($question->resource->resource_name))
                                                        @if($extension = pathinfo(public_path('/storage/files/'.$question->resource->resource_name), PATHINFO_EXTENSION) == 'mp4')
                                                            <div class="p-6 bg-white border-b border-gray-200">
                                                                <video preload="auto" width="100%" controls>
                                                                    <source src="{{ asset('storage/files/'.$question->resource->resource_name)}}" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            </div>
                                                        @elseif($extension = pathinfo(public_path('/storage/files/'.$question->resource->resource_name), PATHINFO_EXTENSION) == 'jpg' || $extension == 'png')

                                                            <img src="{{ asset('storage/files/'.$question->resource->resource_name) }}" style="width: 80%;height: 250px; margin: 0;padding: 0;border: none;display: block;" alt="Question image">

                                                        @elseif($extension = pathinfo(public_path('/storage/files/'.$question->resource->resource_name), PATHINFO_EXTENSION) == 'mp3')
                                                            <audio controls>
                                                                <source src="{{ asset('storage/files/'.$question->resource->resource_name) }}" type="audio/mpeg">
                                                                Your browser does not support the audio element.
                                                            </audio>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="column answer">
                                                    <p class="hidden text-red-500" >Only 1 answer is selectable.</p>
                                                    @foreach($question->answers as $answer)
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <input type="checkbox" id="answers[]" name="answers[]" value="{{$answer->id}}">
                                                                <label for="answers[]" class="col-form-label">{{$answer->answer_text}}</label>

                                                            </div>
                                                        </div>
                                                        <script>
                                                            $(document).ready(function () {

                                                                $('.answer :checkbox').change(function () {
                                                                    var $cs=$(this).closest('.answer').find(':checkbox:checked');
                                                                    if ($cs.length > 1) {
                                                                        this.checked=false;
                                                                        $("p").show();
                                                                    }
                                                                    if ($cs.length < 1) {
                                                                        $("p").hide();
                                                                    }
                                                                });

                                                            });
                                                        </script>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                        <input type="hidden" value="{{$test->id}}" name="testid">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success float-right">Submit</button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
