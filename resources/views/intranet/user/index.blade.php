@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Usuarios</h6>
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-icon-split ml-auto">
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
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Avatar</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->user_type->type }}</td>
                    <td>{{$user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td> 
                      @if($user->avatar == NULL)
                        <img src="/uploads/media/defaultUser.jpg" class="rounded-circle " width="100px" height="100px"/>
                      @else
                        <img src="/uploads/media/{{ $user->avatar }}" class="rounded-circle" width="100px"  height="100px"/>
                      @endif
                    </td>
                    <td style="width:10px">@if( $user->isActive == 0)
                            <div class="alert alert-danger" role="alert" style="width:5px; margin-bottom:0px"></div>   
                        @else
                            <div class="alert alert-success" role="alert" style="width:5px; margin-bottom:0px"></div>  
                        @endif    
                    </td>
                    <td class="text-center">
                        <a href="{{ route('user.show', $user) }}" class="btn btn-primary btn-circle"><i class="fa fa-info"></i></a>
                        <a href="{{ route('user.edit', $user) }}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                        @if( $user->isActive == 0)
                            <a href="{{ route('user.activate', $user) }}" class="btn btn-success btn-circle"><i class="fa fa-check"></i></a>
                        @else
                            <a href="{{ route('user.deactivate', $user) }}" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></a>  
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