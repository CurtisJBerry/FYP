<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Teacher Verification') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">Request Verification to become a Tutor</h3>
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('user-verify') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="school" class="col-form-label">Place of Teaching</label>
                                    <input type="text" class="form-control" name="school" id="school" placeholder="Name of teaching institution or business" required>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="experience" class="col-form-label">Years of experience</label>
                                        <input type="number" class="form-control" id="experience" name="experience" min="1" max="100" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success float-right">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div class="col">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
