@extends('layouts.app')

@section('content')
    <style>
    .inputGroup {
        background-color: #fff;
        display: block;
        margin: 10px 0;
        position: relative;
    }
    .inputGroup .option {
        border: 1px solid #8080805c;
        border-radius: 2mm;
        padding:8px;
        width: 100%;
        display: block;
        text-align: left;
        color: #3c454c;
        cursor: pointer;
        position: relative;
        z-index: 2;
        transition: color 200ms ease-in;
        overflow: hidden;
    }
    .inputGroup .option:before {
        width: 100%;
        height: 10px;
        border-radius: 50%;
        content: '';
        background-color: #5562eb;
        position: absolute;
        transform: translate(-50%, -50%) scale3d(1, 1, 1);
        transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        z-index: -1;
    }
    .inputGroup .option:after {
        width: 32px;
        height: 32px;
        content: '';
        border-radius: 50%;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        transition: all 200ms ease-in;
    }
    .inputGroup input:checked ~ label {
        color: #fff;
    }
    .inputGroup input:checked ~ label:before {
        transform: translate(-50%, -50%) scale3d(56, 56, 1);
        opacity: 1;
    }

    .inputGroup input {
        width: 32px;
        height: 32px;
        order: 1;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        visibility: hidden;
    }
    .card-body{
        border: 1px solid white;
        border-radius: 2mm;
        background-color: white;
    }
    
    .btn-circle {
    width: 40px;
    height: 40px;
    padding: 6px 0px;
    border-radius: 20px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}


</style>
<div id="main" style="background-color: #80808008;">
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a type="button" href=""  onclick="window.history.go(-1); return false;"  style="text-transform: none;">Problems</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$problem->title}}</li>
            </ol>
        </nav>
        <div class="container"> 
            <div class="sub-title"></div>
            <h2> {{$problem->title}}</h2>
            <div class="card-body">
                @foreach($questions as $question)
                    @php ($cont =  $loop->iteration)
                    <div class="form-row  mt-4">
                        <div class="form-group col-md-1">  
                        </div><strong> {{$cont}}. </strong>
                    </div>
                    
                    <div class="form-row mb-2">
                        <div class="form-group col-md-2"></div>
                    @foreach($question->options as $option)
                            <div class="form-group col-md-2 inputGroup">
                                <input class="form-check-input " type="radio" name="{{$cont}}" id="Option{{$option->id}}"value="{{$option->correct}}">
                                <label class="option" for="Option{{$option->id}}">{{$option->option}}</label>
                            </div>
                    @endforeach 
                </div>
                @endforeach
                <button type="button" id="submitformTest" class="btn btn-dark m-3 mr-auto">Realizar Test</button>
            </div>
    </div>
    <script>
        var cont = "<?php echo $cont; ?>";
    </script>
    </section>
    <input name="problem_id" value="{{$problem->id}}" hidden>
    <input name="topic_id" value="{{$problem->topic_id}}" hidden>
</div>
@extends('layouts.modal')

@endsection