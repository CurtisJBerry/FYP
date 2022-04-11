<!-- Add File Modal -->
<div class="modal fade" id="addFileModal{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new file</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('file-upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="file" class="col-form-label">Add new file</label>
                        <input type="file" class="form-control" name="file" id="file" placeholder="Choose file" required>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="filename" class="col-form-label">File Name:</label>
                            <input type="text" class="form-control" id="filename" name="filename" maxlength="30" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" required>

                        <input type="hidden" name="user" value="{{ Auth::user()->id }}">

                        @if(isset($question->id))
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                        @else
                            <input type="hidden" name="submodule" value="{{ $submodule->id }}">
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label for="tags" class="col-form-label">Add Tags for Learner Types: Use ctrl and click for multiple</label>
                            <select name="tags[]" id="tags" class="form-control" multiple>
                                @foreach($alltags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Upload File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if(isset($file))
<!-- Edit File Modal -->
    <div class="modal fade" id="editFileModal{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update a file</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('file-edit',$file->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="file" class="col-form-label">Add new file</label>
                        <input type="file" class="form-control" name="file" id="file" placeholder="Choose file">
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="filename" class="col-form-label">File Name:</label>
                            <input type="text" class="form-control" id="filename" name="filename" maxlength="20" required value="{{$file->resource_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="filename" class="col-form-label">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" required value="{{$file->description}}">

                        <input type="hidden" name="user" value="{{ Auth::user()->id }}">

                        @if(isset($question->id))
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                        @else
                            <input type="hidden" name="submodule" value="{{ $submodule->id }}">
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label for="tags" class="col-form-label">Edit Tags for Learner Types: Use ctrl and click for multiple</label>
                            <select name="tags[]" id="tags" class="form-control" multiple required>
                                @foreach($alltags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        @elseif(isset($question->resource->id))
            <!-- Edit File Modal -->
                <div class="modal fade" id="editFileModal{{$question->resource->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update a file</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('file-edit',$question->resource->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label for="file" class="col-form-label">Add new file</label>
                                        <input type="file" class="form-control" name="file" id="file" placeholder="Choose file">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="filename" class="col-form-label">File Name:</label>
                                            <input type="text" class="form-control" id="filename" name="filename" maxlength="20" required value="{{$question->resource->resource_name}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="filename" class="col-form-label">Description:</label>
                                        <input type="text" class="form-control" id="description" name="description" required value="{{$question->resource->description}}">

                                        <input type="hidden" name="user" value="{{ Auth::user()->id }}">

                                        @if(isset($question->id))
                                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                                        @else
                                            <input type="hidden" name="submodule" value="{{ $submodule->id }}">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="tags" class="col-form-label">Edit Tags for Learner Types: Use ctrl and click for multiple</label>
                                            <select name="tags[]" id="tags" class="form-control" multiple required>
                                                @foreach($alltags as $tag)
                                                    <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Update File</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif


        </div>
    </div>
