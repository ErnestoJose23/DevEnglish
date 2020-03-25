@extends('layouts.app')

@section('content')
<style>
 /* width */
 ::-webkit-scrollbar {
            width: 7px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }
        ul {
            margin: 0;
            padding: 0;
        }
        li {
            list-style: none;
        }
        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }
        .user-wrapper {
            height: 600px;
        }
        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }
        .user:hover {
            background: #eeeeee;
        }
        .user:last-child {
            margin-bottom: 0;
        }
        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }
        .media-left {
            margin: 0 10px;
        }
        .media-left img {
            width: 64px;
            border-radius: 64px;
        }
        .media-body p {
            margin: 6px 0;
        }
        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }
        .messages .message {
            margin-bottom: 15px;
        }
        .messages .message:last-child {
            margin-bottom: 0;
        }
        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }
        .received {
            background: #ffffff;
        }
        .sent {
            background: #3bebff;
            float: right;
            text-align: right;
        }
        .message p {
            margin: 5px 0;
        }
        .date {
            color: #777777;
            font-size: 12px;
        }
        .active {
            background: #eeeeee;
        }
        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }
        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }
</style>
<div id="main">
    <section>
        <button type="button"  class="btn btn-secondary btn-icon-split pull-right mb-4"  data-toggle="modal" data-target="#myModal">
            Nueva consulta
        </button>
        <div class="container mt-5">
            
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="user-wrapper">
                            <ul class="users">
                                @foreach($chats as $chat)
                                <li class="user" id="{{$chat->id}}">
                                    <div class="media">
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
    var receiver_id = '';
    var my_id = "{{Auth::id()}}";
    $(document).ready(function () {
        
        $('.user').click(function(){
            $('.user').removeClass('active');
            $(this).addClass('active');

            chat_id = $(this).attr('id');
            $.ajax({
                type: "get",
                url:"consulta/" + chat_id,
                data: "",
                cache: false,
                success:function(data){
                    $('#messages').html(data);
                }
            })
        });

        $(document).on('keyup', '.input-text input', function (e){
            $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
            });

            Pusher.logToConsole = true;

            var pusher = new Pusher("2552a5d3c8c00d550060", {
                cluster: "eu",
                forceTLS: true
            });

            var channel = pusher.subscribe("my-channel");
            channel.bind("my-event", function(data) {
                var to = [];
                to = data.to.slice();

                if(my_id == data.from){
                    
                }else if(my_id == data.to || to.includes(my_id)){
                    alert(JSON.stringify(data));
                    if(receiver_id == data.from){
                        $('#' + data.from).click();
                    }else{
                        var pending = parseInt($('#' + data.from).find('.pending'.html()));

                        if(pending){
                            $('#' + data.from).find('.pending').html(pending + 1);
                        }else{
                            $('#'+ data.from).append('<span class="pending">1</span>');
                        }
                    }
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
                        
                    }
                })
            }
        });
    });
</script>
@endsection