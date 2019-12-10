@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Editar Elemento</h6>
                <form action="{{ route('resource.destroy', $resource) }}" method="POST" class="d-inline ml-auto">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                    </form>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('resource.update', $resource) }}" >
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">Titulo</label>
                                <input type="text" name="title" placeholder="{{ old('title')}}" class="form-control" value="{{ old('title', $resource->title) }}" >
                            </div>
                            <div class="form-group col-md-8">
                                    <label for="name">Descripcion</label>
                                    <input type="text" name="descp" placeholder="" class="form-control" value="{{ old('descp', $resource->descp) }}" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="url">Url</label>
                                <input type="text" name="url" placeholder="" class="form-control" value="{{old('url', $resource->url)}}">
                            </div>              
                        </div>
                        <div class="form-row">
                            
                            <div class="form-group col-md-4">
                               
                                <label for="active">Activo</label>
                                <select name="active" id="inputState" class="form-control">
                                    <option @if(old('active', $resource->active) == 0) selected @endif value="0">No</option>
                                    <option @if(old('active', $resource->active) == 1) selected @endif value="1">Si</option>
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="tipe">Tipo</label>
                                <select name="tipe" id="inputState" class="form-control">
                                    <option @if(old('tipe', $resource->tipe) == 1) selected @endif  value="1">Video</option>
                                    <option @if(old('tipe', $resource->tipe) == 2) selected @endif value="2">Link</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="topic_id">Temario</label>
                                <select name="topic_id" class="form-control">
                                    <option></option>
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}"
                                            @if(old('topic_id') == $topic->id) selected @endif>
                                            {{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 custom-file">
                                <div class="custom-file">
                                    
                                    <input type="file" class="custom-file-input" name="img">
                                    <label class="custom-file-label" >Subir imagen...</label>
                                </div>
                               
                            </div>
                        </div>
                        <input hidden type="text" name="oldimag" value="{{old('img', $resource->img)}}">
                        <div class="form-group">
                            <button type="submit"class="btn btn-primary m-3">Guardar</button>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
      </div>
@endsection