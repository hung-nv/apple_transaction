<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAccount() {
        return view('backend.user.updateAccount');
    }

    public function account(Request $request) {
        $rules = [
            'name' => 'required',
            'old_password' => 'required|old_password:' . \Auth::user()->password
        ];

        $data = $request->all();
        $this->validate($request, $rules);

        $user = User::findOrFail(\Auth::user()->id);
        if($request->password) {
            $rules['password'] = 'min:6|confirmed|alpha_spaces';
            $data['password'] = bcrypt($data['password']);
            $this->validate($request, $rules);
        } else {
            unset($data['password']);
        }

        if ($user->update($data)) {
            Session::flash('success_message', 'Account Information has been update successful!');
        } else {
            Session::flash('error_message', 'Fail to update Account information');
        }

        return redirect()->route('user.updateAccount');
    }

    public function index()
    {
        $data = User::where('id', '<>', \Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('backend.user.index', [
           'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|unique:users,username|max:255',
            'name' => 'required',
            'password' => 'required|min:6|confirmed|alpha_spaces',
        ];

        $this->validate($request, $rules);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        if (User::create($data)) {
            Session::flash('success_message', 'Your user has been create successful');
        } else {
            Session::flash('error_message', trans('Fail to create user'));
        }
        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('backend.user.update', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rules = [
            'name' => 'required',
            'username' => 'required|unique:users,id,:id',
        ];

        $data = $request->all();
        if ($request->email == $user->email) {
            unset($data['email']);
        }
        $this->validate($request, $rules);
        if ($request->password) {
            $rules['password'] = 'required|confirmed|alpha_spaces|min:6';
            $this->validate($request, $rules);
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        if ($user->update($data)) {
            Session::flash('success_message', 'Your user has been update');
        } else {
            Session::flash('error_message', 'Fail to update user');
        }

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            Session::flash('success_message', 'Your user has been delete');
        } else {
            Session::flash('error_message', 'Fail to delete this user');
        }

        return redirect()->route('user.index');
    }
}
