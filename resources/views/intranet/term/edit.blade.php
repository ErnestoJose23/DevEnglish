@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Termino</h6>
                @if(Auth::user()->isAdmin())
                <form action="{{ route('term.destroy', $term) }}" method="POST" class="d-inline ml-auto">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                </form>
                @else
                    <a class="btn btn-primary nav-link ml-auto" href="{{ route('teacherterminos.index', $term->topic_id) }}">
                        <span>Terminos</span>
                    </a> 
                @endif
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('term.update', $term) }}" enctype="multipart/form-data" id="editForm">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">Termino</label>
                                <input type="text" name="term" placeholder="{{ old('term') }}" class="form-control" value="{{ old('term', $term->term) }}" >
                            </div>
                            <div class="form-group col-md-8">
                                    <label for="name">Definicion</label>
                                    <input type="text" name="definition" placeholder="{{ old('definition') }}" class="form-control" value="{{ old('definition', $term->definition) }}" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="url">AFI</label>
                                <input type="text" name="afi" placeholder="{{ old('afi') }}" class="form-control" value="{{old('afi', $term->afi)}}">
                            </div>              
                            @if(Auth::user()->isAdmin())
                            <div class="form-group col-md-4">
                                <label for="topic_id">Temario</label>
                                <select name="topic_id" class="form-control">
                                    @foreach ($topics as $topic)
                                        <option value="{{ old('topic_id', $topic->id) }}"
                                            @if($term->topic_id == $topic->id) selected @endif>
                                                {{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                         
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

     <script>
        if ({!!$edit!!} == 0) {
            $("#editForm :input").prop("disabled", true);
        }
    </script>
@endsection