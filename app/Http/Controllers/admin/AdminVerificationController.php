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
}
