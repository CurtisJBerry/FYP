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

        $users = User::whereIn('user_type',['user','teacher'])->paginate(10);

        return view('admin/user-management', ['users' => $users]);

    }


    public function destroy($user)
    {

        $toDelete = User::find($user);

        $toDelete->delete();


        return back()->banner('User deleted successfully.');

    }
}
