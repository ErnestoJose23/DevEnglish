@extends('layouts.admin')


@section('content')
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
                        <td>{{ $comment->content }}</td>
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