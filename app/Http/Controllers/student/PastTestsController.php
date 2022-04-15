<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PastTestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $user = User::where('id','=', Auth::user()->id)->with('tests')->paginate(5);


        return view('student/past-tests', ['user' => $user]);

    }
}
