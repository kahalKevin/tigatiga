<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User as User;
use App\Model\UserSubscribe;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use Redirect;
use Session;
use Auth;
use Newsletter;
use Mail;

class UserController extends Controller
{
    //For Validation
    protected $rules = array(
            'email'       => 'required|email',
            'phone' => 'required|numeric',
            'first_name' => 'required'
    );

    //For Validation
    protected $rulesChangePassword = array(
        'old_password' => 'required|string|min:6',
        'password' => 'required|string|min:6|confirmed',
    );

    //For Validation
    protected $rulesResetPassword = array(
        'password' => 'required|string|min:6|confirmed'
    );
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules);
        $user = User::find($id);
        $user->_email = $request->email;
        $user->_first_name = $request->first_name;
        $user->_last_name = $request->last_name;
        $user->_phone = $request->phone;
        $user->gender_id = $request->gender[0];
        $user->save();
        //PUT HERE AFTER YOU SAVE
        \Session::flash('success_update_profile','You have just update your profile.');
        return redirect('/profile');
    }

    public function changePassword(Request $request) 
    {
        Session::put('last_modal', "change_password");
        $this->validate($request, $this->rulesChangePassword);

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        if(!Hash::check($request->old_password, $user->_password)) {
            return redirect('/profile')->withErrors(['old_password' =>'Wrong Old Password !']);
        }
        
        $user->_password = Hash::make($request->password);
        $user->save();
        
        return redirect('/profile');
    }

    public function forgotPassword(Request $request)
    {
        $user = User::where('_email', '=', $request->email)->first();
        $payload = $user->_email . date('Y-m-d H:i:s');

        $token = sha1($payload);
        $url = env('APP_URL') . '/reset-password/' . $token;
        $arg = [
            'email' => $user->_email,
            'url' => $url
        ];

        $test = Mail::send('emails.forgot_password', $arg, function ($m) use ($arg) {
            $m->from(env('MAIL_FROM'), 'supershop');
            $m->subject('Reset your password.');

            $m->to($arg['email']);
        });

        $user->_forgot_token_password = $token;
        $user->save();

        return redirect('/');
    }

    public function resetPasswordForm($token)
    {
        $user = User::where('_forgot_token_password', $token)->first();

        if (empty($user)) {
            return redirect('/');
        }

        return view('profile.reset-password', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        Session::put('last_modal', null);
        $this->validate($request, $this->rulesResetPassword);
        
        $user = User::where('_forgot_token_password', $request->token)->first();
        
        $user->_password = Hash::make($request->password);
        $user->_forgot_token_password = null;
        $user->save();
        
        return redirect('/');
    }

    public function subscribe(Request $request)
    {
        $subscribed = UserSubscribe::where('_email', $request->email)->first();

        if (!empty($subscribed)) {
            $subscribe = new UserSubscribe();
            $subscribe->_email = $request->email;
            $subscribe->save();
        }

        Newsletter::subscribe($request->email);

        return redirect()->back();
    }
}
