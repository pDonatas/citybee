@extends('layouts.app')

@section('content')

<div class="position-fixed w-100 d-flex overflow-auto" style="left: 0px; top: 55px; bottom: 55px;">
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            opacity: 1;
        }
    </style>
    <form action="/addMoney" method="POST" class="m-auto p-5">
        @csrf
        <div class="d-flex flex-wrap align-items-center">
            <div class="mr-5">
                <div>Add amount</div>
                <input value="0.00" min="0" type="number" step="0.01" name="amount" class="h1 p-0 bg-transparent" style="outline:none; border:none; width: 120px;" />
                <input type="hidden" name="userId" value={{$userId}}>
            </div>
            <button type="submit" class="btn btn-primary btn-lg">Add money</button>
        </div>
    </form>

</div>

@endsection
