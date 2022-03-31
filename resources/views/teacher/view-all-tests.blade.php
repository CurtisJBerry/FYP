<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View All Tests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <div class="p-6 bg-white">
                                @if(Auth::user()->user_type !== "user")
                                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#addTestModal">
                                        Add Test
                                    </button>
                                @endif
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Test Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Module Name</th>
                                        <th scope="col" class="relative px-6 py-3">
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @if($tests->count())
                                        @foreach($tests as $test)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{$test->test_name}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{$test->module->subject->subject_name}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{$test->module->module_name}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    <a href="{{ route('teacher-tests.show', $test->id) }}">
                                                       <button class="btn btn-primary">View</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">No Tests found!</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            {{$tests->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Test Modal -->
    <div class="modal fade" id="addTestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new Test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teacher-tests.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <div class="form-group">
                                <label for="testname" class="col-form-label">Test Name:</label>
                                <input type="text" class="form-control" id="testname" name="testname" maxlength="20" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="module" class="col-form-label">Select the Module the test will be for:</label>
                                <select name="module" id="module" class="form-control" size="1" required>
                                    @foreach($modules as $module)
                                        <option value="{{$module->id}}">{{$module->module_name}} - {{$module->subject->subject_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add Question</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
