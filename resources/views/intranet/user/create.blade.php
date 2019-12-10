@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Nuevo Monitor</h6>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="name">Nombre<span class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input type="text" name="email" placeholder="" class="form-control" value="{{ old('email') }}" required>
                            </div>                          
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="password">Contraseña<span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="password_confirmation">Repetir Contraseña<span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" required>
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