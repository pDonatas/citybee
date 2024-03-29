@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <img class="img-thumbnail w-100" src="/img/avatars/no-image.png" alt="{{$user->name}}" />
            </div>
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item">Name: {{$user->name}}</li>
                    <li class="list-group-item">Is suspended?: {{$user->is_suspended ? 'Yes' : 'No'}}</li>
                    @if ($user->hiring_date != null)
                    <li class="list-group-item">Hiring date: {{$user->hiring_date}}</li>
                    @endif
                    <li class="list-group-item">Role: {{
                            $user->role == 0 ? 'User' : ($user->role == 1 ? 'Customer success specialist' : 'Admin')
                        }}</li>
                </ul>
                <div class="row">
                    <div class="col-md-4">
                        <a href="/wallet"><button class="btn-warning w-100">Wallet</button></a>
                    </div>
                    <div class="col-md-4">
                        <a href="/trips_history"><button class="btn-primary w-100">My trips</button></a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{route('contact_info')}}"><button class="btn-secondary w-100">Contact info</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
