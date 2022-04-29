<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\student\ProcessViewingDataController;
use App\Models\User;
use Illuminate\Http\Request;

class AdminProcessAllUserData extends Controller
{
    public function __invoke()
    {

        $allAccounts = User::where('user_type', '!=', 'admin')->get();

        foreach ($allAccounts as $user){
            (new ProcessViewingDataController)->__invoke($user->id);
        }
        return back()->banner('All accounts have been updated');
    }
}
