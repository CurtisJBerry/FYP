<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Changelog;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use phpDocumentor\Reflection\Types\Collection;

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
        $expDate = Carbon::now()->subDays(28);

//        $tags = Tag::with(['resources.changelogs' => function($query) use ($expDate) {
//            $query->where('created_at','>', $expDate)->with('resource.tags');
//            }
//        ])->get();

        $logs = Changelog::with('resource.tags')->where('user_id', $id)->where('created_at','>', $expDate)->get();


        [$under21days, $over21days] = $logs->partition(function ($i) {
            return $i['created_at'] < Carbon::now()->subDays(21);
        });

        echo count($under21days) . "<br>";

        $this->getTagCount($under21days);

        [$under14days, $over14days] = $over21days->partition(function ($i){
            return $i['created_at'] < Carbon::now()->subDays(14);
        });

        echo count($under14days) . "<br>";

        [$under7days, $over7days] = $over14days->partition(function ($i){
            return $i['created_at'] < Carbon::now()->subDays(14);
        });

        echo count($under7days)  . "<br>";

        echo count($over7days) . "<br>";





        //return back()->banner('Accessed page!');
    }

    public function getTagCount(\Illuminate\Database\Eloquent\Collection $collection){

        $reading = 0;
        $visual = 0;
        $auditory = 0;
        $kinesthetic = 0;


        foreach ($collection as $log){
            foreach ($log->resource->tags as $tag){
                switch ($tag->tag_name){

                    case "reading":
                        $reading++;
                        break;

                    case "visual":
                        $visual++;
                        break;

                    case "auditory":
                        $auditory++;
                        break;

                    case "kinesthetic":
                        $kinesthetic++;
                        break;
                }
            }
        }

        return $reading . "<br>" . $visual . "<br>" . $auditory . "<br>" . $kinesthetic;

    }
}
