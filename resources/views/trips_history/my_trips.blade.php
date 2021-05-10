@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="col">
                @foreach($trips as $trip)
                    <div class="col-md-6" style="margin: 20px 0;">
                        <ul class="list-group">
                            @foreach($cars as $car)
                                @if($car->id == $trip->car_id)
                                <li class="list-group-item">Model: {{$car->model}}</li>
                                @endif
                            @endforeach
                            <li class="list-group-item">Start address: {{$trip->start_address}}</li>
                            <li class="list-group-item">End address: {{$trip->end_address}}</li>
                            <li class="list-group-item">Start time: {{$trip->start_time}}</li>
                            <li class="list-group-item">End time: {{$trip->end_time}}</li>
                            <li class="list-group-item">Price: {{$trip->price}}</li>

                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
