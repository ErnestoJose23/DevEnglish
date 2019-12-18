@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Recursos</h6>
                @if(Auth::user()->isAdmin())
                  <a href="{{ route('resource.create') }}" class="btn btn-primary btn-icon-split ml-auto">
                      <span class="icon text-white-50">
                          <i class="fas fa-plus-circle"></i>
                      </span>
                      <span class="text">Nuevo</span>
                  </a>
                @else
                  <a href="{{ route('teacherresource.create', $topic) }}" class="btn btn-primary btn-icon-split ml-auto">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text">Nuevo</span>
                  </a>
                @endif
            </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Tipo</th>
                  <th>Temario</th>
                  <th>Titulo</th>
                  <th>Descripcion</th>
                  <th>Url</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($resources as $resource)
                <tr>
                    <td>@if($resource->tipe == 1) Video
                        @else 
                            Link
                        @endif
                    </td>
                    <td>{{$resource->topic->name }}</td>
                    <td>{{ $resource->title }}</td>
                    <td>{{ $resource->descp}}</td>
                    <td>{{ $resource->url }}</td>
                    <td style="width:10px">@if( $resource->active == 0)
                            <div class="alert alert-danger" role="alert" style="width:5px; margin-bottom:0px"></div>   
                        @else
                            <div class="alert alert-success" role="alert" style="width:5px; margin-bottom:0px"></div>  
                        @endif    
                    </td>
                    <td class="text-center">
                            <a href="{{ route('resource.show', $resource) }}" class="btn btn-primary btn-circle"><i class="fa fa-info"></i></a>
                            <a href="{{ route('resource.edit', $resource->id) }}" class="btn btn-success btn-circle"><i class="fa fa-edit"></i></a>
                        </td>               
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
@endsection