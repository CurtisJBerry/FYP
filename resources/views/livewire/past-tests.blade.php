<div class="p-6 bg-white">

    <table class="w-full">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Test Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Module Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @if($user->count())
            @foreach($user as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{$item->name}}</td>
                        @foreach($item->tests as $test)
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{$test->test_name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$test->module->module_name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{$test->pivot->score}}</td>
                    </tr>
                    @endforeach
            @endforeach
        @else
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">No Modules found!</div>
                        </div>
                    </div>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    {{$user->links()}}
</div>
