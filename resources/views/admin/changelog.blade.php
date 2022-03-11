<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Changelog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Resource Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
{{--                                @if(empty($subjects))--}}
{{--                                    <td class="text-sm font-medium text-gray-900">No Subjects are currently available.</td>--}}
{{--                                @else--}}
{{--                                    @foreach($subjects as $subject)--}}
{{--                                        <tr>--}}
{{--                                            <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                                <div class="flex items-center">--}}
{{--                                                    <div class="ml-4">--}}
{{--                                                        <div class="text-sm font-medium text-gray-900"><a href="{{ route('subjects.show', $subject->id) }}" >{{ $subject->subject_name }}</a></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                            <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                                <div class="text-sm text-gray-500">{{ $subject->exam_board }}</div>--}}
{{--                                            </td>--}}
{{--                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $subject->subject_level }}</td>--}}
{{--                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $subject->description }}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
