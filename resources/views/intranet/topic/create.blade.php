@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Editar Elemento</h6>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('topic.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">Nombre</label>
                                <input type="text" name="name" placeholder="{{ old('name')}}" class="form-control" value="{{ old('name') }}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="isActive">Activo</label>
                                <select name="isActive" id="inputState" class="form-control">
                                    <option selected [ngValue]="false">No</option>
                                    <option [ngValue]="true">Si</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 custom-file">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="media">
                                    <label class="custom-file-label" >Subir imagen...</label>
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group mr-auto">
                                <button type="submit"class="btn btn-primary m-3">Guardar</button>
                            </div>
                        </div>
                        @php
                            $remember_token = Str::random(10);    
                        @endphp
                        <input type="text" name="remember_token" value="{{$remember_token}}" hidden>
                </div>
            </form>
        </div>
    </div>
@endsection