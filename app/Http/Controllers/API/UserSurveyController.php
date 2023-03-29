<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserSurvey;
use App\Models\Document;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use FiveamCode\LaravelNotionApi\Notion;
use Validator;

class UserSurveyController extends BaseController
{
    public function index(){

        $user_id = auth()->user()->id;
        $user_survey = UserSurvey::where('user_id', $user_id)->first();

        if(is_null($user_survey)){

            return $this->sendError('Empty data', ['error'=>'User not completed the survey yet']);

        }else{

            $data['user_id'] = $user_id;
            $data['question_answers'] = json_decode($user_survey->question_answers);
            $success = $data;
            return $this->sendResponse($success, 'User Survey Data');
            
        }
        
    }

    public function createUserSurvey(request $request){

        $User = UserSurvey::where('user_id', $request->user_id)->first();

        if(!$User){
            $data['user_id'] = $request->user_id;
            $data['question_answers'] = json_encode($request->question_answers);

                $user_survey = UserSurvey::create($data);

                if($user_survey){
                    
                    User::where('id', $request->user_id)->update(['survey_complete' => 'Yes']);
                    $success = $user_survey;
                    return $this->sendResponse($success, 'User Survey Created Successfully');

                }else{

                    return $this->sendError('Ooops!', ['error'=>'Something went wrong']);

                }
        }else
        {
            return $this->sendError('Already exists', 'User Already Completed The Survey!');
        }
       
    }


}
