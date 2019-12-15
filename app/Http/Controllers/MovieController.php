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
        $cmd = '"C:\Program Files\MATLAB\R2019b\bin\matlab.exe" -automation -sd ' . $pwd . ' -r "predictItemb('.$movieId.', '.$userId.');exit" -wait -logfile log.txt';
        // exec
        $result = "";
        $last_line = exec($cmd, $output, $retval);
        if ($retval == 0){
            // Read from CSV file which MATLAB has created
            $lines = file('result.csv');

            foreach($lines as $line)
            {
                $result .= $line;
            }

        } else {
            // When command failed
            $result = "Failed";
        }
        return view('movie', [ 'result' => $result, 'movie' =>$movie, 'user'=>$user ]);

    }
}
