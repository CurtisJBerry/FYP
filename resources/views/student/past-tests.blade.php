<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Past Tests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h3 class="font-semibold text-xl text-gray-800 leading-tight">View Past Tests</h3>
                            </div>
                            <div class="p-6 bg-white">
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Test Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SubModule Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Module Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @if($user->count())
                                        @foreach($user as $item)
                                                @foreach($item->tests as $test)
                                                    @if($test->count())
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$test->test_name}}</td>
                                                            @if($test->submodule)
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{$test->submodule->submodule_name}}</td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{$test->submodule->module->module_name}}</td>
                                                            @else
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm">No Sub Module set</td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm">No Module set</td>
                                                            @endif
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm"><a href="{{ route('past-tests.show', $test->id) }}"><button type="submit" class="btn btn-primary">View All Scores</button></a></td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="flex items-center">
                                                                    <div class="ml-4">
                                                                        <div class="text-sm font-medium text-gray-900">No Test Scores found!</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            {{$user->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
