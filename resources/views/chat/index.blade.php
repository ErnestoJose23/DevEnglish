@extends('layouts.app')

@section('content')
<link href="{{ asset('css/chat.css') }}" rel="stylesheet">
<div id="main">
    <section>
        <button type="button"  class="btn btn-secondary btn-icon-split pull-right mb-4 mt-3 mr-3"  data-toggle="modal" data-target="#myModal">
            Nueva consulta
        </button>
        <div class="container mt-5">
            
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="user-wrapper">
                            <ul class="users">
                                @foreach($chats as $chat)
                                <li class="user {{($chat->solved == 1) ? 'resuelta' : ''}}" id="{{$chat->id}}">
                                    @if($chat->messages_count)
                                        <span class="pending">{{$chat->messages_count}}</span>
                                    @endif
                                    <div class="media mt-2 {{($chat->solved == 1) ? 'ml-5' : ''}}">
                                        @if( $chat->solved == 0)
                                            <a href="{{ route('consulta.resolver', $chat) }}" class="btn btn-success btn-circle mt-2" data-toggle="tooltip" data-placement="bottom" title="Marcar como resuelta" style="margin-top: -5px; margin-left: 10px;"><i class="fa fa-check"></i></a>
                                        @endif
                                        <div class="media-left">
                                            @if($chat->topic->avatar == NULL)
                                            <img  src="/uploads/media/default.jpg"  class="media-object" alt="Avatar">
                                            @else
                                            <img src="/uploads/media/{{$chat->topic->avatar}}" class="media-object">
                                            @endif
                                        </div>
                                        
                                        <div class="media-body">
                                            <p class="name">{{$chat->title}}</p>
                                            <p class="email">{{$chat->topic->name}}</p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-8" id="messages">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Nueva consulta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('consulta.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row ">
                    <div class="col-md-12 ">
                        <div class="form-row">
                            <div class="form-group col-md-10 mx-auto mt-2">
                                <label for="topic_id"><h5>Temario</h5></label>
                                <select name="topic_id" class="form-control">
                                    @foreach ($subscribed as $topic)
                                        <option value="{{ $topic->topic->id }}">
                                            {{ $topic->topic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="form-group col-md-10 mx-auto mt-2">
                                <label for="title"><h5>Titulo</h5></label>
                                <input type="text" name="title" placeholder="" class="form-control" value="{{ old('title') }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-10 mx-auto ">
                                <label for="content"><h5>Consulta</h5></label>
                                <textarea name="content" class="form-control" cols="30" rows="10" required></textarea>
                            </div>              
                        </div>
                        <div class="form-group col-md-10 mx-auto ">
                            <div class="form-group">
                                <button type="submit"class="btn btn-secondary m-3">Enviar consulta</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                        @php
                            $token = Str::random(10);    
                        @endphp
                        <input type="text" name="token" value="{{$token}}" hidden>
                    </div>
                </div>
            </form> 
        </div>
        </div>
    </div>
</div>

<script>
    var chat_id = '';
    var my_id = "{{Auth::id()}}";

    Pusher.logToConsole = true;

    var pusher = new Pusher("2552a5d3c8c00d550060", {
        cluster: "eu",
        forceTLS: true
    });

    var channel = pusher.subscribe("my-channel");
    channel.bind("my-event", function(data) {

        if (my_id == data.from) {
                $('#' + data.chat_id_pusher).click();
            } else if (my_id == data.to) {
                if (chat_id == data.chat_id_pusher) {
                    $('#' + data.chat_id_pusher).click();
                } else {
                    var pending = parseInt($('#' + data.chat_id_pusher).find('.pending').html());
                    if (pending) {
                        $('#' + data.chat_id_pusher).find('.pending').html(pending + 1);
                    } else {
                        $('#' + data.chat_id_pusher).append('<span class="pending">1</span>');
                    }
                }
            }
    });

    $(document).ready(function () {
        
        $('.user').click(function(){
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();

            chat_id = $(this).attr('id');
            $.ajax({
                type: "get",
                url:"getChat/" + chat_id,
                data: "",
                cache: false,
                success:function(data){
                    $('#messages').html(data);
                    scrollToBottomFunc();
                }
            })
        });

        $(document).on('keyup', '.input-text input', function (e){
            $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
            });

            
            var content = $(this).val();
            if(e.keyCode == 13 && content != '' & chat_id != ''){
                $(this).val('');

                var datastr = "chat_id=" + chat_id + "&content=" + content;

                $.ajax({
                    type: "POST",
                    url: "/message",
                    data: datastr,
                    cache: false,
                    success: function (data) {
                    },
                    error: function (jqXHR, status, err){

                    },
                    complete: function (){
                        scrollToBottomFunc();
                    }
                })
            }
        });
    });
    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }
</script>
@endsection