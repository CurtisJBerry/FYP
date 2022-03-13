<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $users = User::paginate(10);

        return view('admin/user-management', ['users' => $users]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $signing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)

    {

        $request->validate([
            'user_type' => 'required'
        ]);

        $user->user_type = $request->user_type;
        $user->save();

        return back()->with('success','Signing updated successfully!');
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Models\User $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->banner('Updated User');
    }
}
