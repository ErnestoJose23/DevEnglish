@extends('layouts.app')

@section('content')

<div id="main">
        @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    <section>
        <div class="container">
            <form method="POST" action="{{ route('forum.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row ">
                    <div class="col-md-12 ">
                        <div class="form-row ">
                            <div class="form-group col-md-10 mx-auto">
                                <label for="title"><h5>TItulo</h5></label>
                                <input type="text" name="title" placeholder="" class="form-control" value="{{ old('title') }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-10 mx-auto ">
                                <label for="content"><h5>Contenido</h5></label>
                                <textarea name="content" class="form-control" cols="30" rows="10" required></textarea>
                            </div>              
                        </div>
                        <div class="input-group control-group increment" >
                            <input type="file" name="filename[]" class="form-control">
                            <div class="input-group-btn"> 
                                <button class="btn btn-success incrementar" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                            </div>
                        </div>
                        <div class="clone hide">
                            <div class="control-group input-group" style="margin-top:10px">
                                <input type="file" name="filename[]" class="form-control">
                                <div class="input-group-btn"> 
                                    <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                </div>
                            </div>
                        </div>
                        @php
                            $token = Str::random(10);    
                        @endphp
                        <input type="text" name="token" value="{{$token}}" hidden>
                        <input hidden type="text" name="user_id" value="{{Auth::id() }}">
                        <div class="form-group">
                            <button type="submit"class="btn btn-secondary m-3">Postear</button>
                        </div>
                    </div>
                </div>
            </form> 
        </div>   
    </section>
    <script type="text/javascript">

        $(document).ready(function() {
    
        $(".incrementar").click(function(){ 
            var html = $(".clone").html();
            $(".increment").after(html);
        });
    
        $("body").on("click",".btn-danger",function(){ 
            $(this).parents(".control-group").remove();
        });
    
        });
    
    </script>
    
</div>

@endsection