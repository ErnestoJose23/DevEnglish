@extends('layouts.admin')


@section('content')
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="my-auto font-weight-bold text-primary">Elemento</h6>
                
            </div>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">Nombre</label>
                                <input type="text" name="name" placeholder="" class="form-control" value="{{$topic->name }}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="active">Activo</label>
                                <select name="active" id="inputState" class="form-control" disabled>
                                    <option @if($topic->active) == 0) selected @endif value="0">No</option>
                                    <option @if($topic->active) == 1) selected @endif value="1">Si</option>
                                </select>
                            </div>

                        </div>
                       
                        <div class="form-row">
                            <div class="form-group col-md-6"> 
                                <img src="/uploads/topic/{{ $topic->img }}" width="250px" />                              
                            </div>
                        </div>
                      
                        
                    </div>
                </div>
            </form>
        </div>
      </div>
@endsection