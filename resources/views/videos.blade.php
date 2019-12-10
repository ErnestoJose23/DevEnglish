@extends('layouts.app')

@section('content')
<div id="main">
    <section class="light">
        <div class="container">
            <div class="sub-title">MADE FOR ENTREPRENEURS</div>
            <h2>We are solid</h2>
            <div class="content">
                @foreach($videos as $video)
                <div class="row bottom-border">
                        <div class="col-md-4 col-sm-6 pull-right">
                            <div class="text-right">
                                    <div class="front-content">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <div class="action">
                                                       <a href="{{ $video->url }}" target="_blank">
                                                       <img  src="/uploads/resource/{{$video->img}}" width="336px" height="188px">
                                                        </a>
                                                    </div>  
                                                </div>
                                            </div>    
                                        </div>
    
                            
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-6">
                            <h3>{{$video->title}}</h3>
                            <p>{{$video->descp}}</p>
                        </div>
                    </div>

                @endforeach
                {{--<div class="row bottom-border">
                    <div class="col-md-4 col-sm-6 pull-right">
                        <div class="text-right">
                                <div class="front-content">
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="action">
                                                   <a href="https://www.youtube.com/watch?v=avZTQgLs064" target="_blank">
                                                        <img  src="/img/video/hqdefault.webp">
                                                    </a>
                                                </div>  
                                            </div>
                                        </div>    
                                    </div>

                        
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-6">
                        <h3>What is computer engineering?</h3>
                        <p>Aliquam sed luctus purus, et ultrices tortor. Nam accumsan sodales dignissim. Suspendisse fringilla velit a nunc lobortis, id tincidunt enim malesuada. Suspendisse non nulla sapien. Maecenas elementum risus arcu, consequat luctus ligula fermentum eu.</p>
                    </div>
                </div>
                <div class="row bottom-border">
                        <div class="col-md-4 col-sm-6 pull-right">
                            <div class="text-right">
                                    <div class="front-content">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <div class="action">
                                                       <a href="https://www.youtube.com/watch?v=avZTQgLs064" target="_blank">
                                                            <img  src="/img/video/hqdefault.webp">
                                                        </a>
                                                    </div>  
                                                </div>
                                            </div>    
                                        </div>
    
                            
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-6">
                            <h3>What is computer engineering?</h3>
                            <p>Aliquam sed luctus purus, et ultrices tortor. Nam accumsan sodales dignissim. Suspendisse fringilla velit a nunc lobortis, id tincidunt enim malesuada. Suspendisse non nulla sapien. Maecenas elementum risus arcu, consequat luctus ligula fermentum eu.</p>
                        </div>
                    </div>
                    <div class="row bottom-border">
                            <div class="col-md-4 col-sm-6 pull-right">
                                <div class="text-right">
                                        <div class="front-content">
                                                <div class="row">
                                                    <div class="col-sm-8 col-sm-offset-2">
                                                        <div class="action">
                                                           <a href="https://www.youtube.com/watch?v=avZTQgLs064" target="_blank">
                                                                <img  src="/img/video/hqdefault.webp">
                                                            </a>
                                                        </div>  
                                                    </div>
                                                </div>    
                                            </div>
        
                                
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-6">
                                <h3>What is computer engineering?</h3>
                                <p>Aliquam sed luctus purus, et ultrices tortor. Nam accumsan sodales dignissim. Suspendisse fringilla velit a nunc lobortis, id tincidunt enim malesuada. Suspendisse non nulla sapien. Maecenas elementum risus arcu, consequat luctus ligula fermentum eu.</p>
                            </div>
                        </div>
                        --}}
                
            </div>
        </div>
    </section>
</div>


@endsection