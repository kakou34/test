<?php

namespace App\Http\Controllers;

use App\movie;
use App\User;
use Illuminate\Http\Request;

class RatingPageController extends Controller
{
    public function load($userID) {
        $user = User::find($userID);
        $movies = movie::orderBy('name', 'asc')->get();
        return view('rate', ['user' => $user,
            'movies'=> $movies
        ]);
    }

    public function saveRatings($ratings){
        $arrayRatings = json_decode($ratings, true);
        $user = auth()->user();
        $id = $user->id;


        //store the data to the matrix
        $pwd = getcwd();
        $cmd = '"C:\Program Files\MATLAB\R2019b\bin\matlab.exe" -automation -sd ' . $pwd . ' -r "addRating( '.$id.' ,\''.$ratings.'\');exit" -wait -logfile log.txt';
        // exec
        $last_line = exec($cmd, $output, $retval);

        return redirect()->route('home');
    }
}
