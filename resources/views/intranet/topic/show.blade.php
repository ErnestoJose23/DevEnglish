@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h6 class="my-auto font-weight-bold text-primary">Temario</h6>
            
        </div>
    </div>
    <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Nombre</label>
                            <input type="text" name="name" placeholder="" class="form-control" value="{{$topic->name }}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="active">Activo</label>
                            <select name="active" id="inputState" class="form-control" disabled>
                                <option @if($topic->active) == 0) selected @endif value="0">No</option>
                                <option @if($topic->active) == 1) selected @endif value="1">Si</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 " style="text-align: center"> 
                            @if($topic->media_id == NULL)
                                <img src="/uploads/media/default.jpg" width="25%"/>
                            @else
                                <img src="/uploads/media/{{ $topic->media->archive }}" width="25%"/>
                            @endif                 
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

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