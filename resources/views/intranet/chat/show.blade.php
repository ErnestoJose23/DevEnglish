@extends('layouts.admin')


@section('content')
<link href="{{ asset('css/chat.css') }}" rel="stylesheet">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h6 class="my-auto font-weight-bold text-primary"> Consulta: {{$chat->title}}</h6>
            <a class="btn btn-primary nav-link ml-auto" href="{{ route('consultas.index', $chat->topic_id) }}">
                <span>Consultas</span>
            </a> 
        </div>
    </div>
    <div class="card-body">
        <div id="chat" class="msger-chat" style="border: 1px solid #00000012;">
            <button class="btn btn-secondary" id="topChat" style="right: 3%;"><i class="fa fa-chevron-up"></i></button>
            <div class="msg left-msg">
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
            @foreach($chat->messages as $message)
            <div @if($message->user->id == $chat->user_id) class="msg left-msg" @else class="msg right-msg"  @endif>
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
                      @if($message->hasmedia != NULL)
                        @foreach($message->images() as $image)
                          <img src="/uploads/media/{{ $image }}"  alt="..." width="50%">
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <form method="POST" class="msger-inputarea form-row" action="{{route('message.store')}}"  enctype="multipart/form-data">
            @csrf
            <input name="content" type="text" class="msger-input form-col-11" placeholder="Escribe tu mensaje..." style="  border: none;">
            <input name="user_id" value="{{Auth::user()->id}}" hidden>
            <input name="chat_id" value="{{$chat->id}}" hidden>
            
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">
              Añadir imagen
            </button>
            <button type="submit" class="btn btn-success form-col-1 ml-1">Enviar</button>
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
                                          <input type="file" name="filename[]" class="form-control">
                                          <div class="input-group-btn"> 
                                              <button class="btn btn-success incrementar" type="button"><i class="glyphicon glyphicon-plus"></i>Añadir otra imagen</button>
                                          </div>
                                      </div>
                                      <div class="clone hide" style="display:none">
                                          <div class="control-group input-group" style="margin-top:10px">
                                              <input type="file" name="filename[]" class="form-control">
                                              <div class="input-group-btn"> 
                                                  <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Eliminar</button>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                                @php
                                  $token = Str::random(10);    
                                @endphp
                                <input type="text" name="token" value="{{$token}}" hidden>
                            </div>
                        </div>
                  </div>
                </div>
              </div>
            </div>
        
        </form>
    </div>
</div>   
<script>
    var objDiv = document.getElementById("chat");
    objDiv.scrollTop = objDiv.scrollHeight;
</script>
@endsection