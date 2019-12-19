@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Pruebas</h6>
                @if(Auth::user()->isAdmin())
                  <a href="{{ route('problem.create') }}" class="btn btn-primary btn-icon-split ml-auto">
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
                  <th>Usuario</th>
                  <th>Acciones</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach ($chats as $chat)
                <tr>
                    <td>
                      {{$chat->title}}
                    </td>
                    <td>{{$chat->user->name }}</td>
                    <td class="text-center">
                      <a href="" class="btn btn-primary btn-circle"><i class="fa fa-info"></i></a>
                      @if(Auth::user()->isAdmin())
                        <form action="" method="POST" class="d-inline ml-auto">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                        </form>
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