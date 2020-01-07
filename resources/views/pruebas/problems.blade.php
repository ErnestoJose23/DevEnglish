@extends('layouts.app')

@section('content')


<div id="main">
    <section>
        @if(!$problems->isEmpty())
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a  href="{{route('temario.index')}}">Temarios</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pruebasIndex.show', $topic->id) }}">{{$topic->name}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$problems[0]->problem_type->type}}</li>
            </ol>
        </nav>
        <div class="container mt-5"> 
            <div class="sub-title"></div>
            <h2> {{$problems[0]->problem_type->type}}</h2>
            <table class="table table-striped ">
                <thead>
                    <tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach($problems as $problem)
                    <tr>
                    <th scope="row">1</th>
                    <td>
                        <a href="{{ route('prueba.show', $problem) }}" style="color:black; font-weight: 600;">{{$problem->title}}</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex">
                <div class="mx-auto">
                    {{ $problems->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="container mt-5"> 
            <div class="sub-title"></div>
            <h2>Aun no se ha añadido ningun problema.</h2>
        </div>
        @endif
    </section>

</div>

@endsection