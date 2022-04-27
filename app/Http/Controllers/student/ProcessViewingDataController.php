<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class ProcessViewingDataController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $id
     * @return Response
     */
    public function __invoke($id)
    {
        $expDate = Carbon::now()->subDays(30);

        $user = User::where('id', $id)->with(['changelog' => function($query) use ($expDate) {
            $query->where('created_at','>', $expDate)->with('resource.tags');
            }
        ])->get();

        foreach ($user as $u){
            foreach ($u->changelog as $log){
                dd($log);
                foreach ($log->resource as $res){
                    dd($res->resource_name);
                }
            }
        }

        return back()->banner('Accessed page!');
    }
}
