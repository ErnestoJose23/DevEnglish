@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Nuevo Elemento</h6>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('resource.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">TItulo</label>
                                <input type="text" name="title" placeholder="" class="form-control" value="{{ old('title') }}" >
                            </div>
                            <div class="form-group col-md-8">
                                    <label for="name">Descripcion</label>
                                    <input type="text" name="descp" placeholder="" class="form-control" value="{{ old('descp') }}" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="url">Url</label>
                                <input type="text" name="url" placeholder="" class="form-control" value="{{old('url')}}">
                            </div>              
                        </div>
                        <div class="form-row">
                            
                            <div class="form-group col-md-4">
                                <label for="active">Activo</label>
                                <select name="active" id="inputState" class="form-control">
                                    <option selected value="0">No</option>
                                    <option value="1">Si</option>
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="tipe">Tipo</label>
                                <select name="type" id="inputState" class="form-control">
                                    <option selected value="1">Video</option>
                                    <option value="2">Link</option>
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
                                    <input type="file" class="custom-file-input"name="img">
                                    <label class="custom-file-label" >Subir imagen...</label>
                                </div>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit"class="btn btn-primary m-3">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
@endsection