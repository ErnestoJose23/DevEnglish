@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Temario</h6>
                @if($edit == 1 && Auth::user()->isAdmin())
                <form action="{{ route('topic.destroy', $topic) }}" method="POST" class="d-inline ml-auto">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                </form>
                @endif
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('topic.update', $topic) }}" enctype="multipart/form-data" id="editForm">
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
                                <label for="isActive">Activo</label>
                                <select name="isActive" id="inputState" class="form-control">
                                    <option @if(old('isActive', $topic->isActive) == 0) selected @endif value="0">No</option>
                                    <option @if(old('isActive', $topic->isActive) == 1) selected @endif value="1">Si</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 ">
                                
                                    <label for="title">Descripción</label>
                                <input type="text" name="description" placeholder="{{ old('description')}}" class="form-control" value="{{ old('description', $topic->description) }}" >
                                
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                @if($topic->avatar == NULL)
                                    <img src="/uploads/media/default.jpg" width="50%"/>
                                @else
                                    <img src="/uploads/media/{{ $topic->avatar }}" width="50%"/>
                                    @if($edit == 1 && Auth::user()->isAdmin())
                                        <a href="{{ route('image.delete', $topic) }}"class="btn btn-danger btn-circle  ml-3" onclick="return confirm('¿Estas seguro?')"><i class="fa fa-trash"></i></a>
                                    @endif
                                @endif
                            </div>
                            @if($edit == 1)
                                <div class="form-group col-md-6 custom-file">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="avatar">
                                        <label class="custom-file-label" >Subir imagen...</label>
                                    </div>
                                    
                                </div>
                                <div class="form-group ml-auto">
                                    <button type="submit"class="btn btn-primary m-3">Guardar</button>
                                </div>
                            @endif
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
@if(Auth::user()->isAdmin())
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h6 class="my-auto font-weight-bold text-primary">Profesores asignados</h6>
            
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Cancelar Asignación</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($topic->subscriptions as $subscription)
                    @if($subscription->user->isTeacher())
                        <tr>
                            <td>{{$subscription->user->name }}</td>
                            <td>{{$subscription->user->email }}</td>
                            <td> <form action="{{ route('subscription.destroy', $subscription) }}" method="POST" class="d-inline ml-auto">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-ban"></i></button>
                                </form></td>
                        </tr>
                        @endif
                @endforeach
                </tbody>
            </table>

            <button type="button" id="getTeachers" class="btn btn-dark m-3 mr-auto">Asignar Profesor</button>
        </div>
    </div>
</div>
@endif
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Usuarios suscritos</h6>
                
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Cancelar Suscripción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($topic->subscriptions as $subscription)
                    @if(!$subscription->user->isTeacher())
                    <tr>
                        <td>{{$subscription->user->name }}</td>
                        <td>{{$subscription->user->email }}</td>
                        <td> <form action="{{ route('subscription.destroy', $subscription) }}" method="POST" class="d-inline ml-auto">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-ban"></i></button>
                            </form></td>
                    </tr>
                    @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="col-12 modal-title text-center" id="exampleModalLabel">Profesores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body col-12 text-center " > 
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Asignar profesor</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
    <script>
        if ({!!$edit!!} == 0) {
            $("#editForm :input").prop("disabled", true);
        }

        $("#getTeachers").click(function(e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        $.ajax({
            type: "GET",
            url: "/api/unassigned/{{$topic->id}}",
            data: {},
            success: function(response) {
                var profesores = "";
                $.each(response, function(key, value) {
                    profesores =
                        profesores +
                        "<tr><td>" +
                        value.name +
                        "</td><td>" +
                        value.email +
                        '</td><td> <form method="POST" action=" {{ route("subscription.store")}}">@csrf<input name="user_id" value="' +
                        value.id +
                        '" hidden><input name="topic_id" value="{{$topic->id}}" hidden><button type="submit"class="btn btn-success m-3">Asignar</button></form></td></tr>';
                });

                $("#modal tbody").html(profesores);
                $("#modal").modal("show");
            }
        });
    });
    </script>
@endsection