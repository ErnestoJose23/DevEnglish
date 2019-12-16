@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div id="main" style="background-color: #80808008;">
        <section>
            <div class="container"> 
                <div class="sub-title"></div>
                <h2> {{$problem->title}}</h2>
                <div class="card-body">       
                    <form method="POST" action="{{ route('test.realizar') }}" enctype="multipart/form-data">
                        @csrf
                        @foreach($questions as $question)
                            @php 
                                $cont =  $loop->iteration
                            @endphp
                            <div class="form-row mt-4">
                                    <div class="form-group col-md-1"></div>
                                    <strong> {{$cont}}.  {{$question->title}} </strong>
                                    <input type="text" id="option{{$cont}}" class="form-control inputHuecos">
                                    <input type="text" id="answer{{$cont}}" value="{{$question->options[0]->option}}" hidden>
                                    @if($question->title_2 != NULL)<strong> {{$question->title_2}} </strong>@endif
                            </div>

                        @endforeach
                        <input hidden name="questions" value={{$cont}}>
                        <input hidden name="problem_id" value={{$problem->id}}>
                        <input hidden name="user_id" value={{ Auth::user()->id}}>
                        <button type="button" id="submitform" class="btn btn-dark m-3 mr-auto">Realizar Test</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="col-12 modal-title text-center" id="exampleModalLabel">Puntuación</h5>
                </button>
            </div>
            <div class="modal-body col-12 text-center answermodal"> 
                <h2 id="anscorrect"></h2> 
                <h5 id="perfect" style="color: #4bda4b;"></h5> 
            </div>
            <div class="modal-footer">
                <a type="button" href="" class="btn btn-secondary" onClick="window.location.reload();"  style="text-transform: none;">Vuelve a intentarlo</a>
                <a type="button" href="" class="btn btn-secondary" onclick="window.history.go(-1); return false;"  style="text-transform: none;">Lista de pruebas</a>
                <a type="button" href="{{ route('usuario.show', Auth::user())}}" class="btn btn-primary" style="text-transform: none;">Mi progreso</a>
            </div>
            </div>
        </div>
    </div>

    <script>
    $('#submitform').click(function(e){
        e.preventDefault();
        var anscorrect = 0;
        var cont = "<?php echo $cont; ?>";
        for(i= 0; i< cont ; i++){
            if($('#option'+(i+1)).val() == $('#answer'+(i+1)).val())
                anscorrect = anscorrect + 1;
        }
        var questions = $("input[name=questions]").val();
        var problem_id = $("input[name=problem_id]").val();
        var user_id = $("input[name=user_id]").val();
        var correct = anscorrect;
        if(anscorrect == cont){
            document.getElementById("perfect").innerHTML = "¡Enhorabuena, tu puntuación ha sido perfecta!";
        }

        document.getElementById("anscorrect").innerHTML = anscorrect +" / "+ cont;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            type:'POST',

            url:'/test/resultado',

            data:{questions:questions, problem_id:problem_id, user_id:user_id, correct:correct},
            success:function(data){
                $("#modal").modal('show');
            }
        });
    })
    </script>

@endsection