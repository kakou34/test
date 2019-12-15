<?php

namespace App\Http\Controllers;

use App\movie;
use Illuminate\Http\Request;

class PredictionPageController extends Controller
{
    public function load($userID) {
        $user = auth()->user();
        $movies = movie::orderBy('name', 'asc')->get();
        return view('prediction', ['user' => $user,
            'movies'=> $movies
        ]);
    }
}
