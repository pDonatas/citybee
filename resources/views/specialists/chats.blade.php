@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($chats as $chat)
                            <tr>
                                <th>{{$chat->id}}</th>
                                <th>{{\App\Http\Helper::getUser($chat->initiator)}}</th>
                                <th><a href="{{route('help.accept', $chat->id)}}"><button class="btn btn-success">Help</button></a></th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
