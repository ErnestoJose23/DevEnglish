@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Pruebas</h6>
                <a href="{{ route('problem.create') }}" class="btn btn-primary btn-icon-split ml-auto">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text">Nuevo</span>
                </a>
            </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Tipo</th>
                  <th>Titulo</th>
                  <th>Descripcion</th>
                  <th>Temario</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach ($problems as $problem)
                <tr>
                    <td>
                      {{$problem->problem_type->type }}
                    </td>
                    <td>{{$problem->title }}</td>
                    <td>{{ $problem->content }}</td>
                    <td>{{ $problem->topic->name }}</td>
                    <td style="width:10px">@if( $problem->active == 0)
                            <div class="alert alert-danger" role="alert" style="width:5px; margin-bottom:0px"></div>   
                        @else
                            <div class="alert alert-success" role="alert" style="width:5px; margin-bottom:0px"></div>  
                        @endif    
                    </td>
                    <td class="text-center">
                      <a href="{{ route('problem.show', $problem) }}" class="btn btn-primary btn-circle"><i class="fa fa-info"></i></a>
                      <a href="{{ route('problem.edit', $problem->id) }}" class="btn btn-success btn-circle"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
@endsection