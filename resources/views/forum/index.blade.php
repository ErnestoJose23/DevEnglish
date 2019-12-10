@extends('layouts.app')

@section('content')

<style>
        .table td {
            text-align: center;   
        }
        .clickable-row{
            cursor: pointer;
        }
        </style>
        <div id="main">
            <section>
                <div class="container"> 
                    <div class="sub-title"></div>
                    <h2> Foro</h2>
                </div>
                <div class="tablaPosts mx-auto">
                    <button type="button"  class="btn btn-secondary btn-icon-split pull-right mb-4"  data-toggle="modal" data-target="#myModal">
                        Nuevo Post
                    </button>
                    <table class="table table-striped ">
                        <thead>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr class='clickable-row' data-href='{{ route('forum.show', $post) }}'>
                                <td><h5>{{$post->title}}</h5></td>
                                <td class="pull-right"><div class="row" >Por: {{$post->user->name}}</div>
                                <div class="row" style="margin-right: 20px;">{{$post->created_at->diffForHumans()}}</div></td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    <div class="d-flex">
                        <div class="mx-auto">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
                <div class="modal" id="myModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Nuevo post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('forum.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-12 ">
                                        <div class="form-row ">
                                            <div class="form-group col-md-10 mx-auto mt-2">
                                                <label for="title"><h5>Titulo</h5></label>
                                                <input type="text" name="title" placeholder="" class="form-control" value="{{ old('title') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-10 mx-auto ">
                                                <label for="content"><h5>Contenido</h5></label>
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
                                                <button type="submit"class="btn btn-secondary m-3">Crear Post</button>
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