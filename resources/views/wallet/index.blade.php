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
        <div class="h1 mb-5">Wallet</div>
        @if(isset($error))
        <div>{{$error}}</div>
        @else
        <div class="d-flex flex-wrap align-items-center">
            <div class="mr-5">
                <div>Amount</div>
                <div class="h1">{{$wallet->amount}}</div>
            </div>
            <a href="/add_money_to_wallet" type="submit" class="btn btn-primary btn-lg">Add money</a>
        </div>
        @endif
    </form>

</div>

@endsection
