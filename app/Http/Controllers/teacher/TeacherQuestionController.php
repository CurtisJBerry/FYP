<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Module;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class TeacherQuestionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'type' => 'required',
            'testid' => 'required',

        ]);

        $question = Question::where('description', $request->question)->get();


        if ($question->count()){
            return back()->dangerBanner('A Question with this text already exists, please try again.');
        }else{
            $question= new Question;

            $question->description = $request->question;
            $question->type = $request->type;
            $question->test_id = $request->testid;

            $question->save();


            return back()->banner('Question added successfully.');
        }
    }

    public function show($id){

        $question = Question::where('id',$id)->with('answers')->first();


        return view('teacher/view-question',['question' => $question]);

    }

    public function update(Request $request, $id){

        $request->validate([
            'question' => 'required',
            'row.*.answers' => 'required',
            'row.*.correct' => 'required',
            'row.*.type' => 'nullable',
            'qtype' => 'required'

        ]);

        $correct = $request->correct;
        $answers = $request->answers;
        $type = $request->type;
        $correctcount = 0;

        $question = Question::findorFail($id);
        $answerModels = Answer::where('question_id', $id)->get();

        foreach ($answerModels as $a){
            if($a->correct == 'y'){
                $correctcount += 1;
            }
        }

        if($question){
            $question->update([
                'description' => $request->question,
                'type' => $request->qtype,
            ]);
        }else{
            return back()->dangerBanner('Question not found, please try again.');
        }


        if (count(array_unique($answers, SORT_STRING)) < count($answers)){

            return back()->dangerBanner('Answers cannot have the same text, please try again.');

        }elseif(count(array_keys($correct, "y")) > 1 or count(array_keys($correct, "n")) == config('global.maxanswers') or $correctcount == 1){

            return back()->dangerBanner('An Answer can only and must have one correct answer, please try again.');
        }

        //for each form answer
        foreach ($request->answers as $key => $answer){
            $answerModels[$key]->answer_text = $answers[$key];
            $answerModels[$key]->correct = $correct[$key];
            $answerModels[$key]->type = $type[$key];
            $answerModels[$key]->question_id = $id;
            $answerModels[$key]->save();
        }



        return back()->banner('Question updated successfully.');
    }

    public function destroy($id){

        $question = Question::find($id);

        $question->delete();

        return back()->banner('Question successfully deleted.');

    }

}
