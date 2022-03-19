<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\VerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'school' => 'required',
            'experience' => 'required',
        ]);


        $verify = new VerificationRequest;


        $verify->user_id = Auth::user()->id;
        $verify->place_of_teaching = $request->school;
        $verify->years_experience = $request->experience;
        $verify->status = "submitted";
        $verify->save();

        return back()->banner('Request submitted for administrator approval.');

    }

}

