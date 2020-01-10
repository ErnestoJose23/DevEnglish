@extends('layouts.app')

@section('content')
<style>
p{
  font-size: 16px;
}
</style>
<div id="main">
    <section>
        <div class="container mt-5"> 
        <div class="card mb-3" style="border: 1px #00000036 solid">
            <div class="row no-gutters">
              <div class="col-md-2" style="background-color: gainsboro;">
                  <a  class="nav-link" href="{{ route('usuario.show', $post->user)}}">
                    <div >
                    @if($post->user->avatar == NULL)
                      <img  src="/uploads/media/defaultUser.jpg"  class="rounded-circle pt-2 avatar_foro" alt="Avatar"></div>
                    @else
                      <img  src="/uploads/media/{{ $post->user->avatar }}"  class="rounded-circle pt-2 avatar_foro" alt="Avatar" ></div>
                    @endif
                  <div class="UserPost" >{{$post->user->name}}</div>
                </a>
              </div>
              <div class="col-md-10">
                <div class="card-body">
                  <h5 class="card-title" style="text-align:initial ">{{$post->title}}</h5><hr>
                  <p class="text-left">{!! $post->content !!}</p>
                  @foreach($post->images() as $image)
                    <p style="text-align: center"><img src="/uploads/media/{{ $image }}"  alt="..." width="50%"></p>
                  @endforeach
                  <p class="FechaComment"><small class="text-muted">{{$post->created_at->diffForHumans()}}</small></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr ><hr>
      <div class="container">
        @foreach($post->comments as $comment)

        <div class="card mb-3" style="border: 1px #00000036 solid">
                <div class="row no-gutters">
                    <div class="col-md-2" style="background-color: gainsboro;">
                        <a  class="nav-link" href="{{ route('usuario.show', $comment->user)}}">
                          <div >
                            @if($comment->user->avatar == NULL)
                              <img  src="/uploads/media/defaultUser.jpg"  class="rounded-circle pt-2 avatar_foro" alt="Avatar"></div>
                            @else
                              <img  src="/uploads/media/{{ $comment->user->avatar }}"  class="rounded-circle pt-2 avatar_foro" alt="Avatar" ></div>
                            @endif  
                        <div class="UserPost" >{{$comment->user->name}}</div>
                      </a>
                    </div>
                  <div class="col-md-10">
                    <div class="card-body">
                            @if($comment->user->id == Auth::id() || auth()->user()->isAdmin()) 
                            <form action="{{ route('comment.destroy', $comment) }}" method="POST" class="pull-right">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>
                                </form>
                            @endif
                      <p class="text-left">{{$comment->content}}</p>
                      @if($comment->hasmedia != NULL)
                        @foreach($comment->images() as $image)
                          <p><img src="/uploads/media/{{ $image }}"  alt="..." width="50%"></p>
                        @endforeach
                        @endif
                      <p class="FechaComment"><small class="text-muted">{{$comment->created_at->diffForHumans()}}</small></p>
                    </div>
                  </div>
                </div>
              </div>
          

        @endforeach

        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">
            Añadir comentario
          </button>
        <div class="modal" id="myModal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Nuevo comentario</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('comment.store') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="row ">
                          <div class="col-md-12 ">
                            
                              <div class="form-row">
                                  <div class="form-group col-md-10 mx-auto mt-5 ">
                                      <textarea name="content" class="form-control" cols="30" rows="5" required></textarea>
                                  </div>              
                              </div>
                              <input hidden type="text" name="user_id" value="{{Auth::id() }}">
                              <input hidden type="text" name="post_id" value="{{$post->id}}">
                              <div class="form-row">
                                  <div class="form-group col-md-10 mx-auto mt-5 ">
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
                                  <button type="submit"class="btn btn-secondary m-3">Añadir comentario</button>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
            $(document).ready(function() {

              $("body").on("click",".btn-danger",function(){ 
                  $(this).parents(".control-group").remove();
              });

            });

            $('#myModal').on('shown.bs.modal', function () {
              $('#myModal').modal('show')
            })
          </script>
    </section>
</div>


@endsection