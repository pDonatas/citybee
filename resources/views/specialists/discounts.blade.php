@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Discounts
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    <strong>Success! </strong> {{session('success')}}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    <strong>Error! </strong> {{session('error')}}
                </div>
            @endif
            <form method="post" action="{{route('help.submit.discount', $id)}}">
                @csrf
                <div class="form-group">
                    <label for="user">User</label>
                    <input id="user" type="text" readonly class="form-control"
                           value="{{\App\Models\User::find($id)->name}}"/>
                </div>
                <div class="form-group">
                    <label for="discount">Discount</label>
                    <select name="discount" id="discount" class="form-control" required>
                        <option value="0" selected>0 &percnt;</option>
                        @foreach($discounts as $discount)
                            <option value="{{$discount->id}}">{{$discount->condition }} ({{$discount->percents}} &percnt;)</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" class="btn btn-primary form-control" value="Submit"/>
            </form>
        </div>
    </div>
@endsection
