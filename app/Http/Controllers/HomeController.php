<?php

namespace App\Http\Controllers;

use App\movie;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $movies = movie::orderBy('id', 'asc')->get();
        return view('home', ['user' => $user,
                                   'movies'=> $movies
                                  ]);
    }

    public function saveRatings($ratings){
        $arrayRatings = json_decode($ratings, true);
        $user = auth()->user();
        $id = $user->id;
        $id = 944;

        //store the data to the matrix
        $pwd = getcwd();
        $cmd = '"C:\Program Files\MATLAB\R2019b\bin\matlab.exe" -automation -sd ' . $pwd . ' -r "addRating( '.$id.' ,\''.$ratings.'\');exit" -wait -logfile log.txt';
        // exec
        $last_line = exec($cmd, $output, $retval);


        User::where('id', $user->id)
            ->update(['moviesRated' => sizeof($arrayRatings)]);
        return back();
    }


}
