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
                                <label for="isActive">Activo</label>
                                <select name="isActive" id="inputState" class="form-control">
                                    <option selected [ngValue]="false">No</option>
                                    <option [ngValue]="true">Si</option>
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="tipe">Tipo</label>
                                <select name="type" id="inputState" class="form-control">
                                    <option selected value="1">Video</option>
                                    <option value="2">Link</option>
                                </select>
                            </div>
                            @if(Auth::user()->isAdmin())
                            <div class="form-group col-md-4">
                                <label for="topic_id">Temario</label>
                                <select name="topic_id" class="form-control">
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}">
                                            {{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                                <input name="topic_id" value="{{$topics->id}}"hidden>
                            @endif 
                        </div>
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
                        @php
                        $token = Str::random(10);    
                        @endphp
                        <input type="text" name="token" value="{{$token}}" hidden>
                        <div class="form-group">
                            <button type="submit"class="btn btn-primary m-3">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            
            $(".incrementar").click(function(){ 
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click",".btn-danger",function(){ 
                $(this).parents(".control-group").remove();
            });

            });

            $('#myModal').on('shown.bs.modal', function () {
            $('#myModal').modal('show')
        })
    </script>
@endsection