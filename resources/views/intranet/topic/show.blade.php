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
                    <tr>
                        <td>{{$subscription->user->name }}</td>
                        <td>{{$subscription->user->email }}</td>
                        <td> <form action="{{ route('subscription.destroy', $subscription) }}" method="POST" class="d-inline ml-auto">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-ban"></i></button>
                            </form></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
@endsection