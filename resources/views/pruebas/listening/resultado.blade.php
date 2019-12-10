@extends('layouts.app')

@section('content')
    <style>
    .card-body{
        border: 1px solid white;
        border-radius: 2mm;
        background-color: white;
    }
    


</style>
<div id="main" style="background-color: #80808008;">
        <section>
            <div class="container"> 
                <div class="sub-title"></div>
                <h2> </h2>
                <div class="card-body">
                    {{$cont}}/{{$questions}} 
                </div>
             
            
        </div>
        </section>
    
    </div>

@endsection