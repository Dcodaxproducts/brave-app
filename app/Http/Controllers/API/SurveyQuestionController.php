<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\{
    User,
    SurveyQuestion,
};
use Validator;


class SurveyQuestionController extends BaseController
{
    public function index(){

        $questions = SurveyQuestion::all();
        $groupedQuestions = $questions->map(function ($question) {
            return [
                'question' => $question -> question,
                'answers' => json_decode($question -> answers)
            ];
        });

        // Group the answers by the question
        // $groupedQuestions = $questions->groupBy('question')->map(function ($group) {
        //     $answers = $group->pluck('answers')->toArray();
        //     foreach ($answers as &$answer) {
        //         $answer = json_decode($answer, true);
        //     }
        //     return [
        //         'question' => $group->first()->question,
        //         'answers' => $answers,
        //     ];
        // })->values()->toArray();

        // Return the grouped questions as an array

        if($groupedQuestions){
            $success = $groupedQuestions;
            return $this->sendResponse($success, 'Survey Question Answers Data');
        }else{
            return $this->sendError('Ooops!', ['error'=>'Something went wrong']);
        }
    }

}
