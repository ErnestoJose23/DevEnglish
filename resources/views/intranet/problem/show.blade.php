@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Elemento</h6>
                
            </div>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">Titulo</label>
                                <input type="text" name="title" placeholder="" class="form-control" value="{{$resource->title }}" disabled>
                            </div>
                            <div class="form-group col-md-8">
                                    <label for="name">Descripcion</label>
                                    <input type="text" name="descp" placeholder="" class="form-control" value="{{ $resource->descp }}" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="url">Url</label>
                                <input type="text" name="url" placeholder="" class="form-control" value="{{ $resource->url}}" disabled>
                            </div>              
                        </div>
                        <div class="form-row">
                            
                            <div class="form-group col-md-4">
                               
                                <label for="active">Activo</label>
                                <select name="active" id="inputState" class="form-control" disabled>
                                    <option @if($resource->active) == 0) selected @endif value="0">No</option>
                                    <option @if($resource->active) == 1) selected @endif value="1">Si</option>
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="type">Tipo</label>
                                <select name="type" id="inputState" class="form-control" disabled>
                                    <option @if($resource->type) == 1) selected @endif  value="1">Video</option>
                                    <option @if($resource->type) == 2) selected @endif value="2">Link</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="topic">Temario</label>
                                <input type="text" name="topic" placeholder="" class="form-control" value="{{ $resource->topic->name }}" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6"> 
                                <img src="/uploads/resource/{{ $resource->img }}" width="250px"/>
                            </div>
                        </div>
                      
                        
                    </div>
                </div>
            </form>
        </div>
      </div>
@endsection