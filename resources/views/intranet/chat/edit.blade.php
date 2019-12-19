@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Editar Elemento</h6>
                @if(Auth::user()->isAdmin())
                    <form action="{{ route('problem.destroy', $problem) }}" method="POST" class="d-inline ml-auto">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                    </form>
                @else
                    <a class="btn btn-primary nav-link ml-auto" href="{{ route('teacherproblem.index', $problem->topic_id) }}">
                        <span>Pruebas</span>
                    </a> 
                @endif
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('problem.update', $problem) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">Titulo</label>
                                <input type="text" name="title" placeholder="{{ old('title')}}" class="form-control" value="{{ old('title', $problem->title) }}" >
                            </div>
                            <div class="form-group col-md-8">
                                    <label for="name">Descripcion</label>
                                    <input type="text" name="content" placeholder="" class="form-control" value="{{ old('content', $problem->content) }}" >
                            </div>
                        </div>
                        <div class="form-row">
                            
                            <div class="form-group col-md-4">
                                <label for="active">Activo</label>
                                <select name="active" id="inputState" class="form-control">
                                    <option @if(old('active', $problem->active) == 0) selected @endif value="0">No</option>
                                    <option @if(old('active', $problem->active) == 1) selected @endif value="1">Si</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="problem_type_id">Tipo</label>
                                <select name="problem_type_id" id="select" class="form-control cd-select">
                                    <option @if(old('problem_type_id', $problem->problem_type_id) == 1) selected @endif  value="1">Tipo test</option>
                                    <option @if(old('problem_type_id', $problem->problem_type_id) == 2) selected @endif value="2">Listening</option>
                                    <option @if(old('problem_type_id', $problem->problem_type_id) == 3) selected @endif  value="3">Rellenar Huecos</option>
                                    <option @if(old('problem_type_id', $problem->problem_type_id) == 4) selected @endif value="4">Encontrar Fallo</option>
                                </select>
                            </div>
                            @if(Auth::user()->isAdmin())
                                <div class="form-group col-md-4">
                                    <label for="topic_id">Temario</label>
                                    <select name="topic_id" class="form-control">
                                        @foreach ($topics as $topic)
                                            <option value="{{ $topic->id }}" @if($problem->topic_id == $topic->id) selected @endif> {{ $topic->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            @endif
                        <input type="text" name="oldfile" placeholder="" class="form-control" value="{{$problem->file}}" hidden>
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

            $(function () {
            $('.FormType').hide();
            var div = {!! $problem->problem_type_id !!};
            var divsel = "#d"+div;
            $(divsel).show();
            $('#select').on("change",function () {
                $('.FormType').hide();
                $('#d'+$(this).val()).show();
            }).val(div);
            });
        </script>   

    <div class="card shadow mb-4 FormType" id="d1">
            <div class="card-header py-3">
                    <div class="row">
                        <h6 class="my-auto font-weight-bold text-primary">Preguntas</h6>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($problem->questions as $question)
                        <div class="form-row">
                                <div class="form-group col-md-1"></div>
                                <div class="form-group col-md-10">
                                    <input type="text" name="title" placeholder="" class="form-control" value=" {{$question->title}}" style="background-color: white;" disabled>
                                </div>
                                <form action="{{ route('question.destroy', $question) }}" method="POST" class="d-inline ml-auto">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                                </form>
                        </div>
                        @foreach($question->options as $option)
                            <div class="form-row">
                                    <div class="form-group col-md-2"></div>
                                    <div class="form-group col-md-8">
                                        @if( $option->correct == 1)
                                            <input type="text" name="option" placeholder="" class="form-control" value="{{$option->option}}" style="background-color: #ace6be;"disabled >
                                        @else
                                            <input type="text" name="option" placeholder="" class="form-control" value="{{$option->option}}" style="background-color: white;" disabled >
                                        @endif
                                    </div>  
                                    
                                    <form action="{{ route('option.destroy', $option) }}" method="POST" class="d-inline form-group col-md-2">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                                    </form>
                                
                                </div>
                        @endforeach
                        <form method="POST" action="{{ route('option.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-2"></div>
                                <div class="form-group col-md-7">
                                    <label for="title"><strong>Nueva Opción</strong></label>
                                    <input type="text" name="option" placeholder="" class="form-control" value="{{ old('option') }}" required >
                                    <input type="text" name="question_id" placeholder="" class="form-control" value=" {{$question->id }}" hidden>
                                    <input type="text" name="problem_id" placeholder="" class="form-control" value=" {{$problem->id }}" hidden>
                                </div>  
                                <div class="form-group col-md-2">
                                            
                                    <label for="active"><strong>Opcion Correcta</strong></label>
                                    <select name="correct" id="inputState" class="form-control">
                                        <option selected value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                
                                </div>
                            
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2"></div>
                                <div class="form-group col-md-9" style="text-align: right;">
                                    <button type="submit"class="btn btn-primary m-3 mr-auto">Añadir Opción</button>
                                </div>
                            </div>
                        </form>
                    
                    @endforeach
                    <form method="POST" action="{{ route('question.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                                <div class="form-group col-md-1"></div>
                            <div class="form-group col-md-10">
                                <label for="title"><strong>Nueva Pregunta</strong></label>
                                <input type="text" name="title" placeholder="" class="form-control" value="{{ old('title') }}" required >
                                <input type="text" name="problem_id" placeholder="" class="form-control" value=" {{$problem->id }}" hidden>
                            </div>
                            
                        </div>
                        <div class="form-row">
                                <div class="form-group col-md-2"></div>
                                <div class="form-group col-md-9" style="text-align: right;">
                                    <button type="submit"class="btn btn-primary m-3 mr-auto">Añadir Pregunta</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            <div class="card shadow mb-4 FormType" id="d2">
                    <div class="card-header py-3">
                            <div class="row">
                                <h6 class="my-auto font-weight-bold text-primary">Preguntas</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            @php
                                $audio = $problem->audio();
                            @endphp
                            @if($audio != NULL)
                                        <div style="text-align: center">
                                                <h5>Audio actual </h5>
                                            <audio controls>
                                                <source src="/uploads/media/{{$audio}}" type="audio/ogg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>

                            @endif
                            <form method="POST" action="{{ route('file.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                        <div class="form-group col-md-6 custom-file">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="audio">
                                                <label class="custom-file-label" >Subir archivo...</label>
                                                <input type="text" name="token" value="{{$problem->token}}" hidden>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-row">
                                            <div class="form-group col-md-2"></div>
                                            <div class="form-group col-md-9" style="text-align: right;">
                                                <button type="submit"class="btn btn-primary m-3 mr-auto">Subir archivo</button>
                                            </div>
                                        </div>
                            </form>
                            @foreach($problem->questions as $question)
                                <div class="form-row">
                                        <div class="form-group col-md-1"></div>
                                        <div class="form-group col-md-10">
                                            <input type="text" name="title" placeholder="" class="form-control" value=" {{$question->title}}" style="background-color: white;" disabled>
                                        </div>
                                        <form action="{{ route('question.destroy', $question) }}" method="POST" class="d-inline ml-auto">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                                        </form>
                                </div>
                                
                                @foreach($question->options as $option)
                                
                                    <div class="form-row">
                                            <div class="form-group col-md-2"></div>
                                            <div class="form-group col-md-8">
                                                @if( $option->correct == 1)
                                                    <input type="text" name="option" placeholder="" class="form-control" value="{{$option->option}}" style="background-color: #ace6be;"disabled >
                                                @else
                                                    <input type="text" name="option" placeholder="" class="form-control" value="{{$option->option}}" style="background-color: white;" disabled >
                                                @endif
                                            </div>  
                                            
                                            <form action="{{ route('option.destroy', $option) }}" method="POST" class="d-inline form-group col-md-2">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                                            </form>
                                        
                                        </div>
                                @endforeach
                                <form method="POST" action="{{ route('option.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-2"></div>
                                        <div class="form-group col-md-7">
                                            <label for="title"><strong>Nueva Opción</strong></label>
                                            <input type="text" name="option" placeholder="" class="form-control" value="{{ old('option') }}" required >
                                            <input type="text" name="question_id" placeholder="" class="form-control" value=" {{$question->id }}" hidden>
                                            <input type="text" name="problem_id" placeholder="" class="form-control" value=" {{$problem->id }}" hidden>
                                        </div>  
                                        <div class="form-group col-md-2">
                                                    
                                            <label for="active"><strong>Opcion Correcta</strong></label>
                                            <select name="correct" id="inputState" class="form-control">
                                                <option selected value="0">No</option>
                                                <option value="1">Si</option>
                                            </select>
                        
                                        </div>
                                    
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2"></div>
                                        <div class="form-group col-md-9" style="text-align: right;">
                                            <button type="submit"class="btn btn-primary m-3 mr-auto">Añadir Opción</button>
                                        </div>
                                    </div>
                                </form>
                            
                            @endforeach
                            <form method="POST" action="{{ route('question.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                        <div class="form-group col-md-1"></div>
                                    <div class="form-group col-md-10">
                                        <label for="title"><strong>Nueva Pregunta</strong></label>
                                        <input type="text" name="title" placeholder="" class="form-control" value="{{ old('title') }}" required >
                                        <input type="text" name="problem_id" placeholder="" class="form-control" value=" {{$problem->id }}" hidden>
                                    </div>
                                    
                                </div>
                                <div class="form-row">
                                        <div class="form-group col-md-2"></div>
                                        <div class="form-group col-md-9" style="text-align: right;">
                                            <button type="submit"class="btn btn-primary m-3 mr-auto">Añadir Pregunta</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
            <div class="card shadow mb-4 FormType" id="d3">
                    <div class="card-header py-3">
                            <div class="row">
                                <h6 class="my-auto font-weight-bold text-primary">Preguntas</h6>
                            </div>
                        </div>
                        <div class="card-body">
                                @foreach($problem->questions as $question)
                                <label for="option"><strong>Pregunta</strong></label>
                                <div class="form-row">
                                    <form action="{{ route('question.update', $question) }}" method="POST" class="form-group col-md-11">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-1"></div>
                                            <div class="form-group col-md-4">

                                                <input type="text" name="title" placeholder="" class="form-control" value="{{ old('title', $question->title) }}" style="background-color: white;" required>
                                            </div>
                                            <div class="form-group col-md-1"></div>
                                            <div class="form-group col-md-4">
                                                <input type="text" name="title_2" placeholder="" class="form-control" value="{{ old('title_2', $question->title_2) }}" style="background-color: white;" required>
                                            </div>
                                            <div  class="form-group col-md-2" style="text-align: end">
                                                <button type="submit" class="btn btn-success btn-circle"><i class="fa fa-edit"></i></button>
                                            </div>
                                        </div>
                                    </form>

                                    <form action="{{ route('question.destroy', $question) }}" method="POST" class="form-group col-md-1" >
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-circle confirmar-borrado"><i class="fa fa-trash"></i></button>
                                    </form>
                                    
                                </div> 
                                <label for="option"><strong>Opción</strong></label>
                                @if(!$question->options->isEmpty())
                                @php
                                    $option = $question->options[0]   
                                @endphp
                                
                                <div class="form-row">
                                    <form action="{{ route('option.update', $option) }}" method="POST" class="form-group col-md-11">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-1"></div>
                                            <div class="form-group col-md-4">
                                                <input type="text" name="option" placeholder="" class="form-control" value="{{ old('option', $option->option) }}" required >
                                            </div>
                                            <div class="form-group col-md-1"></div>
                                            <div class="form-group col-md-1" >
                                                <button type="submit" class="btn btn-success btn-circle"><i class="fa fa-edit"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @else
                                <div class="form-row">
                                    <form method="POST" action="{{ route('option.store') }}" enctype="multipart/form-data" class="form-group col-md-11">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-1"></div>
                                            <div class="form-group col-md-4">
                                                <input type="text" name="option" placeholder="" class="form-control"  required >
                                                <input type="text" name="correct" placeholder="" class="form-control" value="1" hidden>
                                                <input type="text" name="question_id" placeholder="" class="form-control" value=" {{$question->id }}" hidden>
                                                <input type="text" name="problem_id" placeholder="" class="form-control" value=" {{$problem->id }}" hidden>
                                            </div> 
                                            <div class="form-group col-md-1"></div>
                                            <div class="form-group col-md-3" >
                                                <button type="submit"class="btn btn-primary  mr-auto">Añadir Opción</button>
                                            </div> 
                                        </div>
                                        
                                    </form>
                                </div>
                                @endif
                            <hr>
                            @endforeach
                            <form method="POST" action="{{ route('question.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-1"></div>
                                    <div class="form-group col-md-10">
                                        <label for="title"><strong>Nueva Pregunta</strong></label>
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <input type="text" name="title" placeholder="" class="form-control" value="{{ old('title') }}" style="background-color: white;" required>
                                            </div>
                                            <div class="form-group col-md-2">
                                                
                                            </div>
                                            <div class="form-group col-md-5">
                                                <input type="text" name="title_2" placeholder="" class="form-control" value=" {{ old('title_2') }}" style="background-color: white;" required>
                                            </div>
                                        </div>
                                        <input type="text" name="problem_id" placeholder="" class="form-control" value=" {{$problem->id }}" hidden>
                                    </div>
                                    
                                </div>
                                <div class="form-row">
                                        <div class="form-group col-md-2"></div>
                                        <div class="form-group col-md-9" style="text-align: right;">
                                            <button type="submit"class="btn btn-primary m-3 mr-auto">Añadir Pregunta</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>

            
@endsection