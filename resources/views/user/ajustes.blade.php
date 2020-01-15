@extends('layouts.app')

@section('content')
<div id="main">
        <section class="light mt-5">
            <div class="container">
                <div class="sub-title">Tu perfil</div>
                <h2>{{ $user->name }} </h2>
                {{ session()->get('error') }}
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if ($errors->has('password'))
                <div class="alert alert-danger" role="alert">
                        Las contraseñas no coinciden
                </div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger">
                    Usuario o Email en uso.
                </div>
                @endif
                <div class="row" style="padding-bottom: 50px">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        @if($user->avatar == NULL)
                            <img src="/uploads/media/defaultUser.jpg" class="rounded-circle avatar"/>
                        @else
                            <img src="/uploads/media/{{ $user->avatar }}" class="rounded-circle avatar" />
                        @endif
                    </div>

                    <div class="col-md-6 text-left">
                            <div class="container">
                                <ul id="tabs" class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Contraseña</a>
                                    </li>
                                    
                                </ul>
                                <div id="content" class="tab-content" role="tablist">
                                    <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                                        
                                        <div id="collapse-A" class="collapse show" data-parent="#content" role="tabpanel" aria-labelledby="heading-A">
                                            <div class="card-body">
                                                    <form method="POST" action="{{ route('usuario.update', $user) }}" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="name">Nombre</label>
                                                                        <input type="text" name="name" placeholder="" class="form-control" value="{{ old('name', $user->name) }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="email">Email</label>
                                                                        <input type="text" name="email" placeholder="" class="form-control" value="{{ old('email', $user->email) }}" required>
                                                                    </div>                          
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="avatar">Avatar</label>
                                                                        <input type="file" name="avatar" class="form-control">
                                                                    </div> 
                                                                </div>
                                                                <input name="old_avatar" value="{{$user->avatar}}" hidden>
                                                                <div class="form-group">
                                                                    <button type="submit"class="btn btn-secondary m-3">Guardar</button>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                                        <div id="collapse-B" class="collapse" data-parent="#content" role="tabpanel" aria-labelledby="heading-B">
                                            <div class="card-body">
                                                    <form method="POST" action="/passwordUpdate">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                            <label for="name">Nueva contraseña<span class="text-danger">*</span></label>
                                                                            <input type="password" name="password" placeholder="" class="form-control" value="" required>
                                                                        </div>
                                                                    </div>
                                                                        <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                            <label for="email">Repetir contraseña<span class="text-danger">*</span></label>
                                                                            <input type="password" name="password_confirmation" placeholder="" class="form-control" value="" required>
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit"class="btn btn-secondary m-3">Guardar</button>
                                                                    </div>    
                                                                </div>
                                                            </div>
                                                        </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="row justify-content-center">
                        </div>
                </div>
            </div>
        </section>
</div>


@endsection