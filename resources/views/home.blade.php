@extends('layouts.app')

@section('script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "pageLength": 100,
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
                    <div class="card-header"> Hello {{$user->name}} !</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if($user->moviesRated<20)
                            Please rate at least 20 movies to continue! The more movies you rate, the better will be our
                            predictions ;)

                            <div id="tableOfMovies">
                                <table class="table table-bordered table-striped" id="dataTable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Movie Name</th>
                                        <th>Your rating</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Movie Name</th>
                                        <th>Your rating</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($movies as $movie)
                                        <tr>
                                            <td>{{$movie->name}}</td>
                                            <td>
                                                <select class="rate_select" id="{{$movie->id}}">
                                                    <option value="0">Select</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <button class="btn-dark rate" id="rate" type="submit" onclick="sendRate()">Submit
                                </button>
                            </div>

                        @else

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="card">
                                        <a href="{{route('PredictionPage', ['user_id'=>  $user->id ])}}">
                                            <div class="card-body">

                                            </div>
                                            <div class="card-header">
                                                <h4 class="item-title">Predict Rating</h4>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <a href="{{route('RatingPage', ['user_id'=>  $user->id ])}}">
                                            <div class="card-body">

                                            </div>
                                            <div class="card-header">
                                                <h4 class="item-title">Rate More Movies</h4>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
    function sendRate() {
        var selects = $('.rate_select');
        var ratings = [];
        if (selects.length > 0) {
            selects.each(function (i) {
                if ($(this).find(":selected").index() !== 0) {
                    ratings.push([i + 1, $(this).find(":selected").index()])
                }
            });
        }

        if (ratings.length > 19) {
            var json = JSON.stringify(ratings);
            //alert(json);
            var url = '{{ route("storeRatings", ":ratings") }}';

            url = url.replace(':ratings', json);

            window.location.href = url;

        } else {
            alert("Please Rate at least 20 Movies")
        }
    }
</script>

















