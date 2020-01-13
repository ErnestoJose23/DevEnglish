@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                @if(Auth::user()->isAdmin())
                  <h6 class="my-auto font-weight-bold text-primary">Consultas</h6>
                @else
                  <h6 class="my-auto font-weight-bold text-primary">Consultas para {{$topic->name}}</h6>
                  
                @endif
                  
            </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  @if(Auth::user()->isAdmin())
                  <th>Temario</th>
                  @endif
                  <th>Titulo</th>
                  <th>Usuario</th>
                  <th>Acciones</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach ($chats as $chat)
                <tr>
                    @if(Auth::user()->isAdmin())
                    <td>
                        {{$chat->topic->name}}
                    </td>
                    @endif
                    <td>
                      {{$chat->title}}
                    </td>
                    <td>{{$chat->user->name }}</td>
                    <td class="text-center">
                      <a href="{{ route('chat.show', $chat) }}" class="btn btn-info btn-circle"><i class="fas fa-comments"></i></a>
                      @if(Auth::user()->isAdmin())
                        <form action="{{ route('chat.destroy', $chat) }}" method="POST" class="d-inline ml-auto">
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