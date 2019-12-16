<?php

namespace App\Http\Controllers;

use App\movie;
use App\User;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function load($userId, $movieId) {
        $movie = movie::find($movieId);
        $user = User::find($userId);
        $pwd = getcwd();
        $cmd = '"C:\Program Files\MATLAB\R2019b\bin\matlab.exe" -automation -sd ' . $pwd . ' -r "predict('.$userId.', '.$movieId.');exit" -wait -logfile log.txt';
        // exec
        $result = "";
        $last_line = exec($cmd, $output, $retval);
        if ($retval == 0){
            // Read from CSV file which MATLAB has created
            $lines = file('prediction.csv');

            foreach($lines as $line)
            {
                $result .= " ".$line;
            }

        } else {
            // When command failed
            $result = "Failed";
        }

        $results = explode(" ", $result);

        $itemBased = round($results[2], 1);
        $userBased = round($results[1], 1);

        if($userBased==0){
            $userBased = "Not enough information, Please rate more movies";
        }

        if($itemBased==0){
            $itemBased = "Not enough information, Please rate more movies";
        }


        return view('movie', [ 'userBased' => $userBased, 'itemBased' => $itemBased, 'movie' =>$movie, 'user'=>$user ]);

    }
}
