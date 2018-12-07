<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ContactUsContent;
use App\Model\ContactUs;
use Carbon\Carbon;

class ContactUsController extends Controller
{
    public function index()
    {
        $content = ContactUsContent::first()->_content ?? '';
        
        return view('contactus.index', compact('content'));
    }

    public function store(Request $request)
    {
        $contactus = new ContactUs;

        $contactus->_name = $request->_name;
        $contactus->_email = $request->_email;
        $contactus->_message = $request->_message;
        $contactus->created_at = Carbon::now();

        $contactus->save();
        
        $request->session()->flash('status', 'Message submitted !');
        return redirect('/contactus');
    }
}
