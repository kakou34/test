@extends('layouts.app')

@section('script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "pageLength": 25,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });

        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Click on the movie that you want to predict</div>
                    <div class="card-body">
                        <div id="tableOfMovies">

                                <table class="table table-bordered table-striped" id="dataTable" style="width:100%" >
                                    <thead>
                                    <tr>
                                        <th>Movie Name</th>

                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Movie Name</th>

                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($movies as $movie)
                                        <tr>
                                            <td><a href="{{route('MoviePage', ['user_id'=>  $user->id, 'movie_id'=>  $movie->id ])}}"> {{$movie->name}} </a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection