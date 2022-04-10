<!-- Delete Question Modal -->
<div class="modal fade" id="deleteQuestionModal{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete a Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('teacher-question.destroy', $question->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <p>Are you sure you want to delete this question?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
                </form>
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
                    @for($i = 1; $i <= 3; $i++)
                        <div class="form-group">
                            <div class="form-group">
                                <label for="answers[]" class="col-form-label">Answer text:</label>
                                <input type="text" class="form-control" id="answers[]" name="answers[]" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="correct" class="col-form-label">Is this the correct answer?</label>
                                <select name="correct[]" id="type" class="form-control" size="1" required>
                                    <option value="y">Yes</option>
                                    <option value="n">No</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" class="form-control" id="questionid" name="questionid[]" value="{{$question->id}}">

                    @endfor

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Answers</button>
                    </div>
                </form>
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
                        <button type="submit" class="btn btn-success">Add Question</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

