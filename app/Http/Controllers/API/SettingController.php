<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Setting,
    Faq,
    Document,
};

use App\Http\Controllers\API\BaseController as BaseController;

class SettingController extends BaseController
{
    private function settings($id)
    {
        return Setting::find($id, ['key', 'details']);
    }

    public function fees()
    {
        $fees = "Fees";
        $data = Document::where('title', 'LIKE', '%'.$fees.'%')->get();
        return $this->sendResponse($data, 'fees Data');
    }

    public function faqs()
    {
        $faqs = Faq::all();
        return $this->sendResponse($faqs, 'Frequently Asked Questions');
    }
}
