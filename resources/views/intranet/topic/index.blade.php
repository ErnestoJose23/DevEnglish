@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Temarios</h6>
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('topic.create')}}" class="btn btn-primary btn-icon-split ml-auto">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text">Nuevo</span>
                    </a>
                @endif
            </div>
        </div>
        <div class="card-body" >
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($topics as $topic)
                <tr>
                    <td>{{ $topic->name }}</td>
                    <td>
                        @if($topic->media_id == NULL)
                            <img src="/uploads/media/default.jpg" width="200px"/>
                        @else
                            <img src="/uploads/media/{{ $topic->media->archive }}" width="200px"/>
                        @endif
                    </td>
                    <td style="width:10px">@if( $topic->active == 0)
                            <div class="alert alert-danger" role="alert" style="width:5px; margin-bottom:0px"></div>   
                        @else
                            <div class="alert alert-success" role="alert" style="width:5px; margin-bottom:0px"></div>  
                        @endif    
                    </td>
                    <td class="text-center">
                        
                        <a href="{{ route('topic.show', $topic) }}" class="btn btn-primary btn-circle" data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fa fa-info"></i></a>
                        <a href="{{ route('topic.edit', $topic) }}" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fa fa-edit"></i></a>
                        @if(Auth::user()->isAdmin())
                        <form action="{{ route('topic.destroy', $topic) }}" method="POST" class="d-inline ml-auto">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                        </form>
                        @else
                            <a href="{{ route('teacherproblem.index', $topic) }}" class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="bottom" title="Pruebas"><i class="fas fa-list-ul"></i></a>
                            <a href="{{ route('teacherresources.index', $topic) }}" class="btn btn-dark btn-circle" data-toggle="tooltip" data-placement="bottom" title="Recursos"><i class="fas fa-fw fa-bookmark"></i></a>
                            <a href="{{ route('consultaTeacher.index', $topic) }}" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="bottom" title="Consultas">  <i class="fas fa-comments"></i></a>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div> 

@endsection