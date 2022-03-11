<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationRequest;
use Illuminate\Http\Request;

class AdminVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $requests = VerificationRequest::paginate(10);

        return view('admin/verification-requests', ['requests' => $requests]);

    }

//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Models\User  $signing
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, User $user)
//
//    {
//
//        $request->validate([
//            'user_type' => 'required'
//        ]);
//
//        $user->user_type = $request->user_type;
//        $user->save();
//
//        return back()->with('success','Signing updated successfully!');
//    }
}
