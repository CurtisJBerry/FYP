<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verification Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <a href="{{ route('home')}}"><button type="button" class="btn btn-primary float-right">
                                        Go Back
                                    </button></a>
                                <h3 class="font-semibold text-xl text-gray-800 leading-tight">Submitted Verification Requests </h3>
                            </div>
                            <div class="p-6 bg-white">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Place of Teaching</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Years of Experience</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="relative px-6 py-3">
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @if($subrequests->isNotEmpty())
                                    @foreach($subrequests as $request)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $request->user->name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $request->place_of_teaching }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->years_experience }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->status }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{$request->user_id}}">
                                                    Update
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Request Modal -->
                                        @if(isset($request->user_id))
                                            <div class="modal fade" id="editModal{{$request->user_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Status of a Verification Request</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('verification-update') }}" method="POST">
                                                                @csrf
                                                                @method('POST')
                                                                <h2 style="font-size: large">Approve or Deny this request?</h2>
                                                                <br>
                                                                <p>Approving will change this User into a Teacher account which will have greater privledges!</p>
                                                                <p>Denying this request will remove it from the table.</p>
                                                                <br>

                                                                <div class="form-group">
                                                                    <label for="status" class="col-form-label">Please choose an option:</label>
                                                                    <select class="form-control" id="status" name="status">
                                                                        <option value="approved">Approve</option>
                                                                        <option value="rejected">Deny</option>
                                                                    </select>

                                                                    <input name="userid" hidden value="{{$request->user_id}}">

                                                                    <input name="requestid" hidden value="{{$request->id}}">
                                                                </div>
                                                            </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">No Requests found!</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                                {{ $subrequests->links() }}
                            </div>


                            <div class="p-6 bg-white border-t border-b border-gray-200">
                                <h3 class="font-semibold text-xl text-gray-800 leading-tight">Approved Verification Requests </h3>
                            </div>
                            <div class="p-6 bg-white">
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Place of Teaching</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Years of Experience</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="relative px-6 py-3">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @if($apprequests->isNotEmpty())
                                        @foreach($apprequests as $request)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $request->user->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-500">{{ $request->place_of_teaching }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->years_experience }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->status }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{$request->user_id}}">
                                                        Update
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">No Requests found!</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                {{ $apprequests->links() }}
                            </div>


                            <div class="p-6 bg-white border-t border-b border-gray-200">
                                <h3 class="font-semibold text-xl text-gray-800 leading-tight">Rejected Verification Requests</h3>
                            </div>
                            <div class="p-6 bg-white">
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Place of Teaching</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Years of Experience</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="relative px-6 py-3">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @if($rejrequests->isNotEmpty())
                                        @foreach($rejrequests as $request)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $request->user->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-500">{{ $request->place_of_teaching }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->years_experience }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->status }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">No Requests found!</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                {{ $rejrequests->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
