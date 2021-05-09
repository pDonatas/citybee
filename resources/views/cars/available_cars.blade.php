@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="col">
                @foreach($cars as $car)
                <div class="col-md-6" style="margin: 20px 0;">
                    <ul class="list-group">
                        <li class="list-group-item">Model: {{$car->model}}</li>
                        <li class="list-group-item">Pay-per-minute: {{$car->pay_per_minute}}</li>
                    </ul>
                </div>
                    <div class="col-md-4">
                        <a href="{{"reserve_car/".$car->id}}"><button class="btn-primary">Reserve</button></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
