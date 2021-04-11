@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @isset($errors)
                    @foreach ($errors->all() as $message)
                        {{$message}}
                    @endforeach
                    @endisset
                    <form action="/edit" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="field">
                            <label>Name:</label>
                            <input type="text" name="name" id="name" value="{{$data->name}}">
                        </div>
                        <div class="field">
                            <label>Surname:</label>
                            <input type="text" name="surname" id="surname" value="{{$data->surname}}" >
                        </div>
                        <div class="field">
                            <label>Email:</label>
                            <input type="text" name="email" id="email" value="{{$data->email}}" >
                        </div>
                        <div class="field">
                            <label>Phone:</label>
                            <input type="text" name="phone" id="phone" value="{{$data->phone}}" >
                        </div>
                        <div class="field">
                            <label>Birthday:</label>
                            <input type="date" name="birth_date" id="birth_date" value="{{$data->birth_date}}" >
                        </div>


                </div>

            </div>
                <div class="field">
                    <div class="control">
                        <button type="submit" class="btn btn-primary"> Confirm </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
