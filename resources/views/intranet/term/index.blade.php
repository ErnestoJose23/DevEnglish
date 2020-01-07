@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Terminos</h6>
                @if(Auth::user()->isAdmin())
                  <a href="{{ route('term.create') }}" class="btn btn-primary btn-icon-split ml-auto">
                      <span class="icon text-white-50">
                          <i class="fas fa-plus-circle"></i>
                      </span>
                      <span class="text">Nuevo</span>
                  </a>
                @else
                  <a href="{{ route('teacherterm.create', $topic) }}" class="btn btn-primary btn-icon-split ml-auto">
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
                  <th>Temario</th>
                  <th>Termino</th>
                  <th>AFI</th>
                  <th>Definicion</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($terms as $term)
                <tr>
                    <td>{{$term->topic->name }}</td>
                    <td>{{ $term->term }}</td>
                    <td>{{ $term->afi}}</td>
                    <td>{{ $term->definition }}</td>
                    <td class="text-center">
                        <a href="{{ route('term.show', $term) }}" class="btn btn-primary btn-circle" data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fa fa-info"></i></a>
                        <a href="{{ route('term.edit', $term) }}" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fa fa-edit"></i></a>
                        @if(Auth::user()->isAdmin())
                          <form action="{{ route('term.destroy', $term) }}" method="POST" class="d-inline ml-auto">
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