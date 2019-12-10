@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Nuevo Elemento</h6>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('problem.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">TItulo</label>
                                <input type="text" name="title" placeholder="" class="form-control" value="{{ old('title') }}" required>
                            </div>
                           
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                    <label for="name">Descripcion</label>
                                    <textarea type="text" name="content" placeholder="" class="form-control" value="{{ old('content') }}" cols="30" rows="5" required ></textarea>
                            </div>      
                        </div>
                        <div class="form-row">
                            
                           
                            <div class="form-group col-md-4">
                                <label for="type">Tipo</label>
                                <select name="type" id="inputState" class="form-control">
                                    <option selected value="1">Tipo Test</option>
                                    <option value="2">Rellenar Huecos</option>
                                    <option value="3">Encontrar Fallo</option>
                                    <option value="4">Listening</option>
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
                            <div class="form-group col-md-4">
                               
                                    <label for="active">Activo</label>
                                    <select name="active" id="inputState" class="form-control">
                                        <option selected value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
    
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