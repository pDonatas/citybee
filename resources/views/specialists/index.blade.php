@extends('layouts.app')
@section('content')
    <div class="card chat">
        <div class="card-header">@if (auth()->check() && auth()->user()->role > 1 && $chat->initiator != auth()->id()) Bendraujate su {{App\Http\Helper::getUser($chat->initiator)}} (ID: {{$chat->initiator}}) @else Chat window @endif</div>
        <div class="card-body">
            <div class="row">
                @php
                $messages = is_array($chat) ? $chat :$chat->messages()->get();
                @endphp
                @foreach($messages as $message)
                <div class="col-md-9 @if(auth()->check() && $message->sender == auth()->id()) offset-md-3 justify-content-end d-flex @endif">
                    <div class="message">
                        <div class="@if(auth()->check() && $message->sender != auth()->id()) text-left @else text-right @endif">{{App\Http\Helper::getUser($message->sender)}} {{$message->created_at}}</div>
                        <p class="@if(auth()->check() && $message->sender != auth()->id()) user @else me @endif">{{$message->message}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @auth
        <div class="card-footer">
            <form method="post" id="form">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <label for="message">Your message</label>
                        <textarea name="message" id="message" class="form-control no-radius" required></textarea>
                    </div>
                    <div class="col-md-3 buttons">
                        <button type="submit" id="submit" disabled class="btn btn-primary form-control no-radius btn-block">Submit</button>
                        @if (auth()->user()->role > 0 && $chat->initiator != auth()->id())
                        <a href="{{route('help.car.connect', $chat->initiator)}}"><button type="button" class="btn btn-primary form-control no-radius">Connect to the car</button></a>
                        <a href="{{route('help.car.technical', $chat->initiator)}}"><button type="button" class="btn btn-primary form-control no-radius">Call for technical service</button></a>
                        <a href="{{route('help.discount', $chat->initiator)}}"><button type="button" class="btn btn-primary form-control no-radius">Give client a discount</button></a>
                        <a href="{{route('help.ban', $chat->initiator)}}"><button type="button" class="btn btn-primary form-control no-radius">Ban the user</button></a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        @endauth
    </div>
@endsection

@section('js')
    @auth
    <script>
        $(document).ready(() => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#form').on('submit', function(e) {
                e.preventDefault();
                let form = $("#form")[0];
                if (!form.checkValidity()) {
                    form.reportValidity();
                } else {
                    $.ajax({
                        url: "{{route('help.write', $chat->id)}}",
                        method: "POST",
                        data: {
                            message: $('#message').val()
                        }
                    }).done(function() {
                        $('#message').val("");
                    });
                }
            });

            setInterval(async () => {
                $.ajax({
                    url: '/api/refresh/{{$chat->id}}',
                    method: 'POST',
                    data: {
                        user: {{auth()->id()}}
                    }
                }).done(function(response) {
                    $('.chat .card-body').html(response.html);
                    if (response.status == 1) {
                        let button = $('#submit');
                        button.removeClass('btn-block');
                        button.attr('disabled', false);
                    }
                });
            }, 1000);
        });
    </script>
    @endauth
@endsection
