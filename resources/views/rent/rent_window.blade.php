@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="col">
                <ul class="list-group">
                    <li class="list-group-item">Model: {{$car->model}}</li>
                    <li class="list-group-item">Pay-per-minute: {{$car->pay_per_minute}}</li>
                    @if($car->status == "Rented")
                        <li class="list-group-item">Start time: {{$start_time}}</li>
                    @endif
                    @if($car->status == "Available")
                        <li class="list-group-item">Start time: {{$start_time}}</li>
                        <li class="list-group-item">End time: {{$end_time}}</li>
                        <li class="list-group-item">Total time: {{$minutes}}</li>
                        <li class="list-group-item">Price: {{$price}}</li>
                    @endif
                </ul>
            </div>
            @if($car->status == "Rented")
                <div class="col-md-4">
                    <a href="{{"/end_rent/".$car->id}}"><button class="btn-primary">End trip</button></a>
                </div>
            @elseif($car->status == "Reserved")
            <div class="col-md-4">
                <a href="{{"/rent_car/".$car->id}}"><button class="btn-primary">Rent</button></a>
            </div>
            @endif
        </div>
    </div>
@endsection
