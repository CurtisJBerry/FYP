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

        $subrequests = VerificationRequest::where('status', "submitted")->paginate(5);

        $apprequests = VerificationRequest::where('status', "approved")->paginate(5);

        $rejrequests = VerificationRequest::where('status', "rejected")->paginate(5);

        return view('admin/verification-requests', compact('subrequests', 'apprequests','rejrequests'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

        $request->validate([
            'status' => 'required',
            'userid' => 'required',
            'requestid' => 'required'
        ]);

        $vrequest = VerificationRequest::where('id', $request->requestid)->first();

        if (empty($vrequest)){
            return back()->dangerBanner('The given verification request could not be found, please try again.');
        }else{

            $user = User::where('id', $request->userid)->first();

            if(empty($user)){
                return back()->dangerBanner('User could not be found and has not been updated');
            }else{

                $vrequest->status = $request->status;
                $vrequest->save();

                if ($request->status === "approved"){

                    $user->user_type = 'teacher';
                    $user->save();

                    return back()->banner('This User has been updated to a Teacher account.');
                }else{
                    return back()->banner('The Users request was rejected.');
                }
            }


        }

    }
}
