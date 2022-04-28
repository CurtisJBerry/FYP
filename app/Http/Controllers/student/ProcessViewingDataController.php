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
        //assign percentages based on weeks
        $week4 = 10;
        $week3 = 20;
        $week2 = 30;
        $week1 = 40;

        $expDate = Carbon::now()->subDays(28);

//        $tags = Tag::with(['resources.changelogs' => function($query) use ($expDate) {
//            $query->where('created_at','>', $expDate)->with('resource.tags');
//            }
//        ])->get();

        $logs = Changelog::with('resource.tags')->where('user_id', $id)->where('created_at','>', $expDate)->get();


        [$under21days, $over21days] = $logs->partition(function ($i) {
            return $i['created_at'] < Carbon::now()->subDays(21);
        });

        echo "Week 4: " . count($under21days) . "<br>";
        $count4 = $this->getTagCount($under21days);
        $arraySum = array_sum($count4);

        if(!$arraySum == 0){
            $week4Percentage = $week4 / $arraySum;
            foreach ($count4 as &$val){
                $val = $val * $week4Percentage;
                $val = round($val, 2);

            }
        }
        unset($val, $arraySum);


        [$under14days, $over14days] = $over21days->partition(function ($i){
            return $i['created_at'] < Carbon::now()->subDays(14);
        });

        echo "Week 3: " . count($under14days) . "<br>";

        $count3 = $this->getTagCount($under14days);
        $arraySum = array_sum($count3);

        if(!$arraySum == 0){
            $week3Percentage = $week3 / $arraySum;
            foreach ($count3 as &$val){
                $val = $val * $week3Percentage;
                $val = round($val, 2);

            }
        }
        unset($val, $arraySum);

        //add array values together
        foreach ($count3 as $key => &$value){
            $value = round($value + $count4[$key], 2);
        }
        unset($value, $val);

        [$under7days, $over7days] = $over14days->partition(function ($i){
            return $i['created_at'] < Carbon::now()->subDays(7);
        });

        echo "Week 2: " . count($under7days)  . "<br>";

        $count2 = $this->getTagCount($under7days);
        $arraySum = array_sum($count2);

        if(!$arraySum == 0){
            $week2Percentage = $week2 / $arraySum;
            foreach ($count2 as &$val){
                $val = $val * $week2Percentage;
                $val = round($val, 2);
            }
        }
        unset($val, $arraySum);

        //add array values together
        foreach ($count2 as $key => &$value){
            $value = round($value + $count3[$key], 2);
        }
        unset($value, $val);


        echo "Week 1: " . count($over7days) . "<br>";

        $count1 = $this->getTagCount($over7days);
        $arraySum = array_sum($count1);

        if(!$arraySum == 0){
            $week1Percentage = $week1 / $arraySum;
            foreach ($count1 as &$val){
                $val = $val * $week1Percentage;
                $val = round($val, 2);
            }
        }

        unset($val, $arraySum);


        //add array values together
        foreach ($count1 as $key => &$value){
            $value = round($value + $count2[$key], 2);
        }
        unset($value, $val);


        $max = max($count1);

        $key = array_search($max, $count1);

        echo "The max value is: " . $max . ", its key is " . $key;


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

        return array('reading' => $reading, 'visual' => $visual, 'auditory' => $auditory, 'kinesthetic' => $kinesthetic);

    }
}
