<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User as User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Redirect;

class UserController extends Controller
{
    //For Validation
    protected $rules = array(
            'email'       => 'required|email',
            'phone' => 'required|numeric',
            'first_name' => 'required'
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
        return redirect('/');
    }
}
