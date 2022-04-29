<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Changelog;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Collection;
use function PHPUnit\Framework\isEmpty;

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



        //get the data from the past 4 weeks
        $expDate = Carbon::now()->subDays(28);

        $logs = Changelog::with('resource.tags')->where('user_id', $id)->where('created_at','>', $expDate)->get();

        if ($logs->isEmpty()){
            return back()->dangerBanner('You have now viewing data, use our service and look at some of the available resources to get a Learner Type suggestion.');
        }else{

            [$under21days, $over21days] = $logs->partition(function ($i) {
                return $i['created_at'] < Carbon::now()->subDays(21);
            });

            //get week 4 data
            $count4 = $this->getTagCount($under21days);
            $count4 = $this->getWeek4Data($week4, $count4);


            [$under14days, $over14days] = $over21days->partition(function ($i){
                return $i['created_at'] < Carbon::now()->subDays(14);
            });


            //get week 3 data
            $count3 = $this->getTagCount($under14days);
            $count3 = $this->getWeek3Data($week3, $count3, $count4);


            [$under7days, $over7days] = $over14days->partition(function ($i){
                return $i['created_at'] < Carbon::now()->subDays(7);
            });

            //get week 2 data
            $count2 = $this->getTagCount($under7days);
            $count2 = $this->getWeek2Data($week2, $count2, $count3);

            //get week 1 data
            $count1 = $this->getTagCount($over7days);
            $count1 = $this->getWeek1Data($week1, $count1, $count2);


            //get max value and key from array
            $max = max($count1);
            $key = array_search($max, $count1);

            if (count(array_unique($count1)) == 2){
                return back()->dangerBanner('Your viewing data is too similar to set your Learner Type.');
            }else{

                $user = User::where('id', $id)->first();

                $user->learner_type = $key;
                $user->save();

                return back()->banner('Your Learner Type has been updated to ' . ucfirst($key) . ' as your viewing history matched this type.');
            }

        }


    }

    public function getWeek4Data($week4, $count4){

        $arraySum = array_sum($count4);

        if(!$arraySum == 0){
            $week4Percentage = $week4 / $arraySum;
            foreach ($count4 as &$val){
                $val = $val * $week4Percentage;
                $val = round($val, 2);

            }
        }
        unset($val, $arraySum);

        return $count4;
    }

    public function getWeek3Data($week3, $count3, $count4){

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

        return $count3;

    }

    public function getWeek2Data($week2, $count2, $count3){

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

        return $count2;

    }

    public function getWeek1Data($week1, $count1, $count2){

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

        return $count1;

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
