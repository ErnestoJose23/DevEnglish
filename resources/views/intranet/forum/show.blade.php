@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h6 class="my-auto font-weight-bold text-primary">Post </h6>
            
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Titulo</th>
                  <th>Post</th>
                  <th>Creado por:</th>
                  <th>Activo</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>{{ $post->title }}</td>
                      <td><p>{{ $post->content }}</p>
                          @foreach($post->images() as $image)
                            <img src="/uploads/media/{{ $image }}"  alt="..." width="10%">
                          @endforeach
                      </td>
                      <td>{{ $post->user->name }}</td>
                      <td style="width:10px">@if( $post->active == 0)
                              <div class="alert alert-danger" role="alert" style="width:5px; margin-bottom:0px"></div>   
                          @else
                              <div class="alert alert-success" role="alert" style="width:5px; margin-bottom:0px"></div>  
                          @endif    
                      </td>
                  </tr>
              </tbody>
            </table>
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
      </div>
@endsection