@extends('layouts.app')

@section('content')

<div id="main">
    <section>
        <div class="container"> 
            <div class="sub-title"></div>
            <h2> Tus consultas</h2>
        </div>
        <div class="tablaPosts mx-auto">
            <button type="button"  class="btn btn-secondary btn-icon-split pull-right mb-4"  data-toggle="modal" data-target="#myModal">
                Nueva consulta
            </button>
            <table class="table table-striped tablePost">
                <thead>
                </thead>
                <tbody>
                    @foreach($chats as $chat)
                        <tr class='clickable-row' data-href='{{ route('consulta.show', $chat) }}'>
                        <td><h5>{{$chat->title}}</h5></td>
                        <td class="pull-right"><div class="row" >Temario: {{$chat->topic->name}}</div>
                        <div class="row" style="margin-right: 20px;">{{$chat->created_at->diffForHumans()}}</div></td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
            <div class="d-flex">
                <div class="mx-auto">
                    {{ $chats->links() }}
                </div>
            </div>
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nueva consulta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('consulta.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row ">
                            <div class="col-md-12 ">
                                <div class="form-row">
                                    <div class="form-group col-md-10 mx-auto mt-2">
                                        <label for="topic_id"><h5>Temario</h5></label>
                                        <select name="topic_id" class="form-control">
                                            @foreach ($subscribed as $topic)
                                                <option value="{{ $topic->id }}">
                                                    {{ $topic->topic->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row ">
                                    <div class="form-group col-md-10 mx-auto mt-2">
                                        <label for="title"><h5>Titulo</h5></label>
                                        <input type="text" name="title" placeholder="" class="form-control" value="{{ old('title') }}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10 mx-auto ">
                                        <label for="content"><h5>Consulta</h5></label>
                                        <textarea name="content" class="form-control" cols="30" rows="10" required></textarea>
                                    </div>              
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10 mx-auto mt-2 ">
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
                                <div class="form-group col-md-10 mx-auto ">
                                    <div class="form-group">
                                        <button type="submit"class="btn btn-secondary m-3">Enviar consulta</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                                @php
                                    $token = Str::random(10);    
                                @endphp
                                <input type="text" name="token" value="{{$token}}" hidden>
                                <input hidden type="text" name="user_id" value="{{Auth::id() }}">
                            </div>
                        </div>
                    </form> 
                </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
@endsection