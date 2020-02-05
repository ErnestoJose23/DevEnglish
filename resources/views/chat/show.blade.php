@extends('layouts.app')

@section('content')
<link href="{{ asset('css/chat.css') }}" rel="stylesheet">
<div id="main">
    <section>
        <div class="container mt-5"> 
            <div class="sub-title"></div>
            <h5>{{$chat->title}}  
                @if( $chat->solved == 0)
                    <a href="{{ route('consulta.resolver', $chat) }}" class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="bottom" title="Marcar como resuelta" style="margin-top: -5px; margin-left: 10px;"><i class="fa fa-check"></i></a>
                @else
                    <h5 style="color: green"> Resuelta </h5>
                @endif
            </h5>
        </div>

        <div class="card-body container" style="text-align: inherit;">
            <div id="chat" class="msger-chat" style="border: 1px solid #00000012;">
                <button class="btn btn-secondary" id="topChat"><i class="fa fa-chevron-up"></i></button>
                <div class="msg right-msg">
                    @if($chat->user->avatar == NULL)
                        <div class="msg-img" style="background-image: url(/uploads/media/defaultUser.jpg)"></div>
                    @else
                        <div class="msg-img" style="background-image: url(/uploads/media/{{ $chat->user->avatar }})"></div>
                    @endif
                    <div class="msg-bubble">
                        <div class="msg-info">
                            <div class="msg-info-name">{{$chat->user->name}}</div>
                            <div class="msg-info-time">{{$chat->created_at}}</div>
                        </div>
                        <div class="msg-text">
                            <p>{{$chat->content}}</p>
                            @foreach($chat->images() as $image)
                            <img src="/uploads/media/{{ $image }}"  alt="..." width="50%">
                            @endforeach
                        </div>
                    </div>
                </div>
                @php
                    $avatar = $chat->user->avatar;
                    $username = $chat->user->name;  
                @endphp
                <script>
                    userimg = "<?php echo $avatar ?>";
                    username = "<?php echo $username ?>";
                </script>
                @foreach($chat->messages as $message)
                <div @if($message->user->id == $chat->user_id) class="msg right-msg" @else class="msg left-msg"  @endif>
                    @if($message->user->avatar == NULL)
                        <div class="msg-img" style="background-image: url(/uploads/media/defaultUser.jpg)"></div>
                    @else
                        <div class="msg-img" style="background-image: url(/uploads/media/{{ $message->user->avatar }})"></div>
                    @endif
                    <div class="msg-bubble">
                        <div class="msg-info">
                            <div class="msg-info-name">{{$message->user->name}}</div>
                            <div class="msg-info-time">{{$message->created_at}}</div>
                        </div>
                        <div class="msg-text">
                        <p>{{$message->content}}</p>
                        @if($message->image != NULL)
                            <a href="/uploads/media/{{ $message->image }}" target="_blank"><img src="/uploads/media/{{ $message->image }}"  alt="..." width="50%"></a>
                        @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <form method="post" enctype="multipart/form-data" class="msger-inputarea form-row" id="messageForm" action="javascript:void(0)">
                @csrf 
                <input id="content" name="content" type="text" class="msger-input form-col-11" placeholder="Escribe tu mensaje..." style="  border: none;">
                <input id="user_id" name="user_id" value="{{Auth::user()->id}}" hidden>
                <input id="chat_id" name="chat_id" value="{{$chat->id}}" hidden>
                
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">
                Añadir imagen
                </button>
                <button type="submit" id="enviarMensaje" class="btn btn-success form-col-1 ml-1">Enviar</button>
                <div class="modal" id="myModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Añadir imagen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row ">
                                <div class="col-md-12 ">
                                    <div class="form-row">
                                        <div class="form-group col-md-10 mx-auto">
                                        <div class="input-group control-group increment" >
                                            <input id="filename" type="file" name="filename" class="form-control">

                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger ml-3" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </section>
</div>
<script>
    var objDiv = document.getElementById("chat");
    objDiv.scrollTop = objDiv.scrollHeight;

    

    
</script>
@endsection