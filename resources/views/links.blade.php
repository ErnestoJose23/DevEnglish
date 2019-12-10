@extends('layouts.app')

@section('content')
<div id="main">


        <section class="light" id="blog">
                <div class="container">
                    <div class="sub-title">Our Latest News</div>
                    <h2>From the blog</h2>
                    <div class="content">
                       @foreach($links as $link)
                       
                       <div class="col-sm-4">
                            <a href="#" class="item-blog-summary">
                                <div class="thumb-holder">
                                    <img src="/uploads/resource/{{$link->img}}" alt="img" class="img-responsive" width="360px" height="240px">
                                </div>
                                <div class="heading">
                                    <h5>{{$link->title}}</h5>
                                </div>
                                <div class="summary">
                                    <p>{{$link->descp}}</p>
                                </div>
                            </a>
                        </div>
                        
                       @endforeach
                        {{--
                        <div class="col-sm-4">
                            <a href="#" class="item-blog-summary">
                                <div class="thumb-holder">
                                    <img src="/img/media/blog/blog-1.jpg" alt="Blog" class="img-responsive">
                                </div>
                                <div class="heading">
                                    <h5>How to be amazing and cool</h5>
                                </div>
                                <div class="summary">
                                    <p>Maecenas ultricies pellentesque venenatis. Integer luctus ut sem eget vulputate. Pellentesque eget turpis sed quam dictum fermentum. Mauris cursus elit sed libero luctus scelerisque.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="#" class="item-blog-summary">
                                <div class="thumb-holder">
                                    <img src="/img/media/blog/blog-1.jpg" alt="Blog" class="img-responsive">
                                </div>
                                <div class="heading">
                                    <h5>How to be amazing and cool</h5>
                                </div>
                                <div class="summary">
                                    <p>Maecenas ultricies pellentesque venenatis. Integer luctus ut sem eget vulputate. Pellentesque eget turpis sed quam dictum fermentum. Mauris cursus elit sed libero luctus scelerisque.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                                <a href="#" class="item-blog-summary">
                                    <div class="thumb-holder">
                                        <img src="/img/media/blog/blog-1.jpg" alt="Blog" class="img-responsive">
                                    </div>
                                    <div class="heading">
                                        <h5>How to be amazing and cool</h5>
                                    </div>
                                    <div class="summary">
                                        <p>Maecenas ultricies pellentesque venenatis. Integer luctus ut sem eget vulputate. Pellentesque eget turpis sed quam dictum fermentum. Mauris cursus elit sed libero luctus scelerisque.</p>
                                    </div>
                                </a>
                        </div>
                        <div class="col-sm-4">
                                <a href="#" class="item-blog-summary">
                                    <div class="thumb-holder">
                                        <img src="/img/media/blog/blog-1.jpg" alt="Blog" class="img-responsive">
                                    </div>
                                    <div class="heading">
                                        <h5>How to be amazing and cool</h5>
                                    </div>
                                    <div class="summary">
                                        <p>Maecenas ultricies pellentesque venenatis. Integer luctus ut sem eget vulputate. Pellentesque eget turpis sed quam dictum fermentum. Mauris cursus elit sed libero luctus scelerisque.</p>
                                    </div>
                                </a>
                        </div>
                        <div class="col-sm-4">
                                <a href="#" class="item-blog-summary">
                                    <div class="thumb-holder">
                                        <img src="/img/media/blog/blog-1.jpg" alt="Blog" class="img-responsive">
                                    </div>
                                    <div class="heading">
                                        <h5>How to be amazing and cool</h5>
                                    </div>
                                    <div class="summary">
                                        <p>Maecenas ultricies pellentesque venenatis. Integer luctus ut sem eget vulputate. Pellentesque eget turpis sed quam dictum fermentum. Mauris cursus elit sed libero luctus scelerisque.</p>
                                    </div>
                                </a>
                        </div>
                        <div class="col-sm-4">
                                <a href="#" class="item-blog-summary">
                                    <div class="thumb-holder">
                                        <img src="/img/media/blog/blog-1.jpg" alt="Blog" class="img-responsive">
                                    </div>
                                    <div class="heading">
                                        <h5>How to be amazing and cool</h5>
                                    </div>
                                    <div class="summary">
                                        <p>Maecenas ultricies pellentesque venenatis. Integer luctus ut sem eget vulputate. Pellentesque eget turpis sed quam dictum fermentum. Mauris cursus elit sed libero luctus scelerisque.</p>
                                    </div>
                                </a>
                            </div>
                            --}}
                            
                    </div>
                </div>
            </section>

</div>

@endsection