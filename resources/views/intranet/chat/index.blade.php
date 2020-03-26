@extends('layouts.admin')


@section('content')
<link href="{{ asset('css/chat.css') }}" rel="stylesheet">
<div class="card shadow mb-4">
  <section>
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
       {{-- <div class="card-header py-3">
            <div class="row">
                @if(Auth::user()->isAdmin())
                  <h6 class="my-auto font-weight-bold text-primary">Consultas</h6>
                @else
                  <h6 class="my-auto font-weight-bold text-primary">Consultas para {{$topic->name}}</h6>
                  
                @endif
                  
            </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Resuelta</th>
                  @if(Auth::user()->isAdmin())
                  <th>Temario</th>
                  @endif
                  <th>Titulo</th>
                  <th>Usuario</th>
                  <th>Acciones</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach ($chats as $chat)
                <tr>
                  <td style="width:10px">
                    @if( $chat->solved == 0)
                      <div class="alert alert-danger" role="alert" style="width:5px; margin-bottom:0px"></div>   
                    @else
                          <div class="alert alert-success" role="alert" style="width:5px; margin-bottom:0px"></div>  
                    @endif    
                  </td>
                  <td
                    @if(Auth::user()->isAdmin())
                    <td>
                        {{$chat->topic->name}}
                    </td>
                    @endif
                    <td>
                      {{$chat->title}}
                    </td>
                    <td>{{$chat->user->name }}</td>
                    <td class="text-center">

                      <a href="{{ route('chat.show', $chat) }}" class="btn btn-info btn-circle"><i class="fas fa-comments"></i></a>
                      @if(Auth::user()->isAdmin())
                        <form action="{{ route('chat.destroy', $chat) }}" method="POST" class="d-inline ml-auto">
                              @method('DELETE')
                              @csrf
                              <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                        </form>
                        @endif
                        @if( $chat->solved == 0)
                          <a href="{{ route('consulta.resolver', $chat) }}" class="btn btn-success btn-circle"><i class="fa fa-check"></i></a>
                        @endif
                    </td>
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>--}}
     
@endsection