<?php

namespace App\Http\Controllers\Control;

use App\User;
use Auth;
use Validator;
use Mail;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{

    public function index()
    {
        $users = User::paginate(12);
        return view('admin.users.index', compact('users'))->withTitle('Users');
    }


    public function create()
    {
        $roles = Role::lists('title', 'id');
        return view('admin.users.create', compact('roles'))->withTitle('Add New User');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|max:255',
            'role_id' => 'required',
            'status' => 'required',
        ]);
        $input = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
            'status' => $request->input('status'),
            'password' => Hash::make($request->input('password')),
        ];
        $user = User::insert([$input]);
        if ($request->has('notify')) {
            $credential = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];
            $this->sendCredentials($credential);
        }
        return redirect()->route('admin.user')->withMessage('User was successfully created!');
    }


    public function sendCredentials($data)
    {
        Mail::send('emails.admin-user-created-notification', $data, function ($message) use ($data) {
            $message->from('webadmin@floorworld.com', 'Your admin account has been created!');
            $message->to($data['email'])->subject('Account Credentials');
        });
        return true;
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::lists('title', 'id');

        return view('admin.users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'role_id' => 'required',
            'status' => 'required',
        ]);
        $input = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
            'status' => $request->input('status'),
        ];
        if($request->has('password')){
            $input['password'] = Hash::make($request->input('password'));
        }

        User::where('id', $id)->update($input);

        return redirect()->route('admin.user')->withMessage('User was successfully updated!');
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);
        User::destroy($id);
        return redirect()->route('admin.user')->withMessage('User was successfully deleted!');
    }


    public function login()
    {
        return view('layouts.login');
    }


    public function postLogin(Request $request)
    {
        //Check validation
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect('/admin')
                ->withErrors($validator, 'login')->withInput();
        }
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),           
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard');
        } else {
            return redirect()->to('admin')->with('message', 'These credentials do not match our records.')->withInput();
        }
    }


    public function account($id){
        if(Auth::user()->id != $id)
            return redirect()->to('admin')->with('message', 'Oops! I am smart then you :)');
        $user = User::findOrFail($id);
        return view('controls.users.account', compact('user'))->withTitle('Your Account');
    }

    public function accountUpdate(Request $request, $id){
        if(Auth::user()->id != $id)
            return redirect()->to('admin')->with('message', 'Oops! I am smart then you :)');

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);

        $input = [
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ];
        if($request->has('password')){
            $input['password'] = Hash::make($request->input('password'));
        }

        User::where('id', $id)->update($input);
        return redirect()->route('admin.account', $id)->withMessage('Account was successfully updated!');

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


}