@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Posts</h6>
              
            </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Titulo</th>
                  <th>Post</th>
                  <th>Creado Por:</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td style="width:10px">@if( $post->isActive == 0)
                            <div class="alert alert-danger" role="alert" style="width:5px; margin-bottom:0px"></div>   
                        @else
                            <div class="alert alert-success" role="alert" style="width:5px; margin-bottom:0px"></div>  
                        @endif    
                    </td>
                    
                    <td class="text-center">
                            <a href="{{ route('post.show', $post) }}" class="btn btn-primary btn-circle"><i class="fa fa-info"></i></a>
                            @if( $post->isActive == 0)
                                <a href="{{ route('post.edit', $post) }}" class="btn btn-success btn-circle"><i class="fa fa-check"></i></a>
                            @else
                                <a href="{{ route('post.edit', $post) }}" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></a>  
                            @endif  
                        </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
@endsection