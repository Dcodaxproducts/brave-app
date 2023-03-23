<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Faq;
use App\Http\Controllers\API\BaseController as BaseController;

class SettingController extends BaseController
{
    private function settings($id)
    {
        return Setting::find($id, ['key', 'details']);
    }

    public function dynamicDocuments()
    {
        $data['support'] = $this->settings(1);
        $data['documents'] = $this->settings(2);
        $data['fees'] = $this->settings(3);

        return $this->sendResponse($data, 'Settings Data');
    }

    public function faqs()
    {
        $faqs = Faq::all();
        return $this->sendResponse($faqs, 'Frequently Asked Questions');
    }
}
