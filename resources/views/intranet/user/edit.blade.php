@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary"> Usuario</h6>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update', $user) }}" id="editForm" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="name">Nombre<span class="text-danger">*</span></label>
                                <input type="text" name="name"  placeholder="{{ old('name')}}"  class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input type="text" name="email"  placeholder="{{ old('email')}}"  class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="user_type_id">Tipo</label>
                                <select name="user_type_id" class="form-control">
                                    @foreach ($usertypes as $usertype)
                                        <option value="{{ old('user_type_id', $user->user_type_id) }}"  @if($user->user_type_id == $usertype->id) selected @endif>
                                            {{ $usertype->type }}</option>
                                    @endforeach
                                </select>
                            </div>            
                        </div>
                        <div class="form-row mt-3">
                            @if($user->avatar == NULL)
                                <img src="/uploads/media/defaultUser.jpg" class="rounded-circle" width="150px"  height="150px"/>
                            @else
                                <img src="/uploads/media/{{ $user->avatar }}" class="rounded-circle" width="150px"  height="150px"/>
                            @endif
                            <div class="form-group col-md-4 ml-5">
                                <label for="avatar">Avatar</label>
                                <input type="file" name="avatar" class="form-control">
                            </div> 
                            <input name="old_avatar" value="{{$user->avatar}}" hidden>
                        </div>
                        {{--
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
                        --}}
                        @if($edit == 1)
                            <div class="form-group">
                                <button type="submit"class="btn btn-primary m-3">Guardar</button>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        if ({!!$edit!!} == 0) {
            $("#editForm :input").prop("disabled", true);
        }
    </script>
@endsection