@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h6 class="my-auto font-weight-bold text-primary">Post </h6>
            <div class="d-inline ml-auto">
                @if( $post->isActive == 0)
                    <a href="{{ route('post.activate', $post) }}" class="btn btn-success btn-circle"><i class="fa fa-check"></i></a>
                @else
                    <a href="{{ route('post.deactivate', $post) }}" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></a>  
                @endif  
            </div>
            
        </div>
    </div>
    <div class="card-body">
        <div class="card mb-3" style="border: 1px #00000036 solid">
          <div class="row no-gutters">
            <div class="col-md-2" style="background-color: gainsboro;">
                
                  <div style="text-align: center">
                  @if($post->user->media_id == NULL)
                    <img  src="/uploads/media/defaultUser.jpg"  class="rounded-circle pt-2" alt="Avatar" width="80%">
                  @else
                    <img  src="/uploads/media/{{ $post->user->media->archive }}"  class="rounded-circle pt-2" alt="Avatar" width="80%">
                  @endif
                <div class="UserPost" >{{$post->user->name}}</div>
              </div>
            </div>
            <div class="col-md-10">
              <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5><hr>
                <p class="text-left">{!! $post->content !!}</p>
                @foreach($post->images() as $image)
                  <p style="text-align:center"><img src="/uploads/media/{{ $image }}"  alt="..." width="50%"></p>
                @endforeach
                <p class="FechaComment"><small class="text-muted">{{$post->created_at->diffForHumans()}}</small></p>
              </div>
            </div>
          </div>
    </div>
  </div>
</div>
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Comentarios </h6>
                
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Comentario</th>
                      <th>Usuario</th>
                      <th>Fecha</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($post->comments as $comment)
                    <tr>
                        <td><p>{{ $comment->content }}</p>
                            @foreach($comment->images() as $image)
                            <img src="/uploads/media/{{ $image }}"  alt="..." width="10%">
                            @endforeach
                        </td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->date }}</td>
                        <td class="text-center">
                            <form action="{{ route('comment.destroy', $comment) }}" method="POST" class="pull-right">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
      </div>
@endsection