<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Admin,
    UserSurvey,
    SurveyQuestion,
};
use Session;

class SurveyQuestionController extends Controller
{
    public function index(){

        $data['questions'] = SurveyQuestion::orderBy('id','desc')->get();
        return view('admin.questions.index',$data);

    }

    public function create(){

        return view('admin.questions.add');

    }

    public function store(request $request){

        // $validatedData = $request->validate([
        //     'question' => 'required|string',
        // ]);

        // if ($validator->fails()) {
        //     return back()->withInput()->withErrors(['question.required', 'Question is required']);
        // }

        $data = $request->all();

        $arr = ($request->answers);
        $answers = json_encode($arr);
        $question = new SurveyQuestion();
        $question->question = $request->question;
        $question->question_description = $request->question_description ?? NULL;
        $question->answers = $answers;

        if($question->save()){
            Session::flash('success','Question/Answers created successfully');
            return redirect()->route('admin.questions.index');
        }else{
            Session::flash('error','Error while saving Question/Answers');
            return redirect()->route('admin.questions.index');
        }

    }

    public function edit($id){

        $data['data'] = SurveyQuestion::where('id', $id)->first();

        $data['questions'] = $data['data']->question;
        $data['answers'] = json_decode($data['data']->answers);

        return view('admin.questions.edit', $data);

    }

    public function update(request $request){

        $data = $request->all();
        $sqa = SurveyQuestion::find($request->id);
        $sqa->fill($data);

        if($sqa->save()){

            Session::flash('success','Questions & Answers Updated successfully');
            return redirect()->route('admin.questions.index');

        }else{

            Session::flash('error','Failed to update Questions & Answers');
            return redirect()->route('admin.questions.index');
        }
    }

    public function destroy($id){
        
        $question_answers = SurveyQuestion::find($id);
        if($question_answers->delete()){
            Session::flash('success','Questions/Answers deleted successfully');
            return redirect()->route('admin.questions.index');
        }

        else{
            Session::flash('error','Failed to delete Question/Answers');
            return redirect()->route('admin.questions.index');
        }

    }

}
