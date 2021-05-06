@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" >
            <div class="card" >
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body" >
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

            </div>
            <div class="card">
            </div>
                <div class="card-header"  >{{ __('Car rent') }}</div>

                <div class="card-body" >

                    <a href="{{'available_cars'}}"><button class="btn btn-primary">Rent a car</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
