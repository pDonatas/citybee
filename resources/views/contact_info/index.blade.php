@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item">Name: {{\Illuminate\Support\Facades\Auth::user()->name}}</li>
                        <li class="list-group-item">Surname: {{\Illuminate\Support\Facades\Auth::user()->surname}}</li>
                        <li class="list-group-item">Email: {{\Illuminate\Support\Facades\Auth::user()->email}}</li>
                        <li class="list-group-item">Phone: {{\Illuminate\Support\Facades\Auth::user()->phone}}</li>
                        <li class="list-group-item">Birthday: {{\Illuminate\Support\Facades\Auth::user()->birth_date}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <a href="{{"edit_contact_info/".\Illuminate\Support\Facades\Auth::user()->id}}"><button class="btn-secondary w-100">Edit contact info</button></a>
            </div>
        </div>
    </div>
@endsection
