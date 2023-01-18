<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function show(Request $request)
    {
        return view('user_profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        if ($request->isMethod('POST')) {

            $messages = [
                'required' => 'Поле :attribute бязательно к заполнению',
                'email.email'    => 'Поле :attribute формата E-mail',
            ];

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'name'  => 'required',
            ], $messages);

            if ($validator->fails()) {
                return redirect()->route('user_profile')->withErrors($validator)->withInput();
            }

            $user = $request->user();

            $user->name = $request->name;
            $user->email = $request->email;

            $user->save();

            return redirect()->route('user_profile')->with(['message' => 'Success update fields']);
        }
    }
}
