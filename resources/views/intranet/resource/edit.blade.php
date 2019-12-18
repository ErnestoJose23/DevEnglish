@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Recurso</h6>
                @if($edit == 1)
                <form action="{{ route('resource.destroy', $resource) }}" method="POST" class="d-inline ml-auto">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                </form>
                @endif
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('resource.update', $resource) }}" enctype="multipart/form-data" id="editForm">
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
                                <select name="type" id="inputStat" class="form-control">
                                    <option @if(old('type', $resource->type) == 1) selected @endif  value="1">Video</option>
                                    <option @if(old('type', $resource->type) == 2) selected @endif value="2">Link</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="topic_id">Temario</label>
                                <select name="topic_id" class="form-control">

                                    @foreach ($topics as $topic)
                                        <option value="{{ old('topic_id', $topic->id) }}"
                                            @if($resource->topic_id == $topic->id) selected @endif>
                                            {{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                        <div class="form-row">
                            <h5>Imagenes</h5>
                            <div class="form-group col-md-12 ">
                                @foreach($resource->images() as $image)
                                    <img src="/uploads/media/{{ $image }}"  alt="..." width="25%">
                                @endforeach
                            </div>
                        </div>
                        @if($edit == 1)
                            <div class="form-row">
                                <div class="form-group col-md-10 mx-auto mt-5 ">
                                    <div class="input-group control-group increment" >
                                        <input type="file" name="filename[]" class="form-control">
                                        <div class="input-group-btn"> 
                                            <button class="btn btn-success incrementar" type="button"><i class="glyphicon glyphicon-plus"></i>Añadir otra imagen</button>
                                        </div>
                                    </div>
                                    <div class="clone hide" style="display:none">
                                        <div class="control-group input-group" style="margin-top:10px">
                                            <input type="file" name="filename[]" class="form-control">
                                            <div class="input-group-btn"> 
                                                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="text" name="token" value="{{$resource->token}}" hidden>
                            <div class="form-group">
                                <button type="submit"class="btn btn-primary m-3">Guardar</button>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        if ({!!$edit!!} == 0) {
            $("#editForm :input").prop("disabled", true);
        }
    </script>

@endsection