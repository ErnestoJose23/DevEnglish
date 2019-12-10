@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Editar Elemento</h6>
                <form action="{{ route('topic.destroy', $topic) }}" method="POST" class="d-inline ml-auto">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                    </form>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('topic.update', $topic) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">Nombre</label>
                                <input type="text" name="name" placeholder="{{ old('name')}}" class="form-control" value="{{ old('name', $topic->name) }}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="active">Activo</label>
                                <select name="active" id="inputState" class="form-control">
                                    <option @if(old('active', $topic->active) == 0) selected @endif value="0">No</option>
                                    <option @if(old('active', $topic->active) == 1) selected @endif value="1">Si</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                @if($topic->media_id == NULL)
                                    <img src="/uploads/media/default.jpg" width="50%"/>
                                @else
                                    <img src="/uploads/media/{{ $topic->media->archive }}" width="50%"/>
                                @endif
                            </div>
                            <div class="form-group col-md-6 custom-file">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="media">
                                    <label class="custom-file-label" >Subir imagen...</label>
                                    <input type="text" name="media_id" value="{{$topic->media_id}}" hidden>
                                </div>
                                
                            </div>
                            <div class="form-group ml-auto">
                                <button type="submit"class="btn btn-primary m-3">Guardar</button>
                            </div>
                        </div>
                </div>
            </form>
        </div>
    </div>
@endsection