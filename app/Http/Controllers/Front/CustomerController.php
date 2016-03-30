<?php

namespace App\Http\Controllers\Front;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Validator;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    public function getRegister()
    {
        return view('front.customer.register');
    }

    public function postRegister(Request $request)
    {

        //Check validation
        $validator = Validator::make($request->all(), [
            'first-name' => 'required|max:255',
            'last-name' => 'required|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'login')
                ->withInput();
        }
        $input = [
            'first-name' => $request->input('first-name'),
            'last-name' => $request->input('last-name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ];
        $customer = Customer::insert([$input]);

        /*/*if ($request->has('notify')) {
            $credential = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];
            $this->sendCredentials($credential);
        }**/

        return redirect()->route('customer.login')->withMessage('User was successfully created!');

    }

    public function getLogin()
    {
        return view('front.customer.login');
    }

    public function postLogin(Request $request)
    {
        //Check validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator, 'login')
                ->withInput();
        }
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::guard('customers')->attempt($credentials)) {

            return redirect()->intended('account/dashboard');
        }


       return redirect()->route('customer.login')->withMessage('Incorrect email or password')->withInput();

    }

    public function dashboard()
    {
        return view('front.customer.dashboard');

    }

    public function getLogout()
    {
        Auth::guard('customers')->logout();
        return redirect()->route('customer.login')
            ->with('status', 'success')
            ->with('message', 'Logged out');

    }
}
