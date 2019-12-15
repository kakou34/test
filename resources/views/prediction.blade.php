@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Click on the movie that you want to predict</div>
                    <div class="card-body">
                        <div id="tableOfMovies">
                            <table id="table1" class="table table-bordered table-striped" style="width:100%">
                                <tr>
                                    <th>Movie Name</th>

                                </tr>
                                @foreach($movies as $movie)
                                    <tr>
                                        <th> <a href="{{route('MoviePage', ['user_id'=>  $user->id, 'movie_id'=>  $movie->id ])}}"> {{$movie->name}} </a> </th>
                                    </tr>
                                @endforeach
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection