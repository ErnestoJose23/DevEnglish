@extends('layouts.app')

@section('content')

<style>
.table td {
   text-align: center;   
}
</style>
<div id="main">
    <section>
        <div class="container"> 
            <div class="sub-title"></div>
            <h2> {{$type}}</h2>
       
            <table class="table table-striped ">
                <thead>
                    <tr>
                    <th scope="col"></th>
                    <th scope="col" style="text-align:center ">Prueba</th>
                    <th scope="col"  style="text-align:center ">Dificultad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($problems as $problem)
                    <tr>
                    <th scope="row">1</th>
                    <td>
                        @switch($type_route)
                            @case(1)
                                <a href="{{ route('test', $problem) }}">{{$problem->title}}</a>
                                @break
                            @case(4)
                                <a href="{{ route('listening', $problem) }}">{{$problem->title}}</a>
                                @break
                        @endswitch
                    </td>
                    <td>Otto</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
    </div>
    </section>

</div>

@endsection