@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Nuevo Elemento</h6>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('term.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">Termino</label>
                                <input type="text" name="term" placeholder="" class="form-control" value="{{ old('term') }}" >
                            </div>
                            <div class="form-group col-md-8">
                                    <label for="name">Definicion</label>
                                    <input type="text" name="definition" placeholder="" class="form-control" value="{{ old('definition') }}" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="url">AFI</label>
                                <input type="text" name="afi" placeholder="" class="form-control" value="{{old('afi')}}">
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
                        <div class="form-group">
                            <button type="submit"class="btn btn-primary m-3">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection