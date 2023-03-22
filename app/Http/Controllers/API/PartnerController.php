<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\{
    User, 
    Partner,
};
use Validator;

class PartnerController extends BaseController
{
    public function index(){
        
        $partners = Partner::all();
        if($partners){
            $success = $partners;
            return $this->sendResponse($success, 'Partners Data');
        }else{
            return $this->sendError('Ooops!', ['error'=>'Something went wrong']);
        }
    }
}
