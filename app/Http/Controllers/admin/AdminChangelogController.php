<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Changelog;
use Illuminate\Http\Request;

class AdminChangelogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $changelog = Changelog::paginate(10);

        return view('admin/changelog', ['changelog' => $changelog]);

    }
}
