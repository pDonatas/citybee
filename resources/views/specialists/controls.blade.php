@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            {{$car->model}} Control
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item">Main data</li>
                        <li class="list-group-item"></li>
                        <li class="list-group-item">Manufacturer: {{explode(' ', $car->model)[0]}}</li>
                        <li class="list-group-item">Model: {{explode(' ', $car->model)[1]}}</li>
                        <li class="list-group-item">Status: In ride</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item">Status data</li>
                        <li class="list-group-item"></li>
                        <li class="list-group-item">Fuel: 15l</li>
                        <li class="list-group-item">Speed: 100 KM/H</li>
                        <li class="list-group-item">License plate: {{$car->number_plate}}</li>
                    </ul>
                </div>
            </div>
            <div class="card-footer">
                <div class="buttons">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{route('lock', $car->id)}}"><button class="btn btn-primary form-control">Lock / Unlock car</button></a>
                        </div>
                        <div class="col-md-4">
                            <a href="#"><button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary form-control">Current location</button></a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{route('help.chat', $car->rentSession()->first()->user_id)}}"><button class="btn btn-primary form-control">Contact the driver</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$car->model}} {{$car->number_plate}} location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="map"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
        }
    </style>
    <script>
        // Initialize and add the map
        @php
        $location = explode(";", $car->current_location);
        $latitude = $location[0];
        $longtitude = $location[1];
        @endphp
        function initMap() {
            // The location of Uluru
            const uluru = { lat: {{ $latitude }}, lng: {{ $longtitude }} };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
    </script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5aFk6v6g-Wbnrgc3ARb7B9ih6-3iiDsQ&callback=initMap"
             type="text/javascript"></script>
@endsection
