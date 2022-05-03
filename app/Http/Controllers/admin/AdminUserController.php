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

    public function update(Request $request) {

        $request->validate([
            'userid' => 'required',
            'role' => 'required',
        ]);

        $user = User::where('id', $request->userid)->first();

        if (empty($user)){
            return back()->dangerBanner('User could not be found! No changes have been saved.');
        }else{

            $user->user_type = $request->role;
            $user->save();

            return back()->banner('User\'s role has been updated to ' . ucfirst($request->role));

        }

    }


    public function destroy($user)
    {

        $toDelete = User::find($user);

        $toDelete->delete();

        return back()->banner('User deleted successfully.');

    }
}
