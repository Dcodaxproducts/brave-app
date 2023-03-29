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
                'id' => $question-> id,
                'question' => $question -> question,
                'question_description' => $question -> question_description,
                'answers' => json_decode($question -> answers)
            ];
        });

        if($groupedQuestions){
            $success = $groupedQuestions;
            return $this->sendResponse($success, 'Survey Question Answers Data');
        }else{
            return $this->sendError('Ooops!', ['error'=>'Something went wrong']);
        }
    }

}
