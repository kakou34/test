@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Here is your prediction</div>
                    <div class="card-body">

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="card">

                                        <div class="card-body">
                                            <h3>{{$movie->name}}</h3>
                                            <h4>{{$result}}</h4>

                                        </div>
                                        <div class="card-header">
                                            <h4 class="item-title">Item-based prediction</h4>

                                        </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">

                                        <div class="card-body">

                                        </div>
                                        <div class="card-header">
                                            <h4 class="item-title">User-based prediction</h4>

                                        </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
