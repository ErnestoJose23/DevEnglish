@extends('layouts.app')

@section('content')
<div id="hero" class="dark">
        <div id="carousel-item" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/img/Slides/Slide1.jpg" alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <div class="heading-image"><img src="/img/media/SliderIcon.png" alt=""></div>
                            <div class="sub-title">Welcome to</div>
                            <h1 style="font-family: Century Gothic; text-transform: none; font-weight: 400;">Dev<strong>English</strong></h1>
                            <div class="footer-image"><img src="/img/media/SliderLine.png" alt=""></div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/img/Slides/Slide3.jpg" alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <div class="heading-image"><img src="/img/media/SliderIcon.png" alt=""></div>
                            <div class="sub-title"></div>
                            <h1 >Develop your english</h1>
                            <div class="footer-image"><img src="/img/media/SliderLine.png" alt=""></div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carousel-item" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-item" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div id="main">
        <section class="light" id="services">
            <div class="container">
                <h2>¿Qué hacer?</h2>
                <div class="content">
                    <div class="row">
                        <div class="col-sm-1" style="    max-width: 2px;
                        padding-left: 35px;">
                        </div>
                        <div class="col-sm-2 ">
                            <div class="thumbnail">
                                <img src="/img/media/subscribe.png" alt="Polygon 1" width="150px">
                                <div class="caption">
                                    <h5>Suscribete a nuestros temarios</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <i class="fa fa-arrow-circle-right fa-4x mt-4 arrowright"></i>
                            <i class="fa fa-arrow-circle-down fa-4x mt-4 arrowdown mb-4"></i>
                        </div>
                        <div class="col-sm-2">
                            <div class="thumbnail">
                                <img src="/img/media/information.png" alt="Polygon 1" height="150px">
                                <div class="caption">
                                    <h5>Recopila informacion</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <i class="fa fa-arrow-circle-right fa-4x mt-4 arrowright"></i>
                            <i class="fa fa-arrow-circle-down fa-4x mt-4 arrowdown mb-4"></i>
                        </div>
                        <div class="col-sm-2">
                            <div class="thumbnail">
                                <img src="/img/media/test.png" alt="Polygon 2" height="150px">
                                <div class="caption">
                                    <h5>Pon a prueba tus conocimientos</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <i class="fa fa-arrow-circle-right fa-4x mt-4 arrowright"></i>
                            <i class="fa fa-arrow-circle-down fa-4x mt-4 arrowdown mb-4"></i>
                        </div>
                        <div class="col-sm-2">
                            <div class="thumbnail">
                                <img src="/img/media/graph.jpg" alt="Polygon 3" height="150px">
                                <div class="caption">
                                    <h5>Visualiza tu progreso</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="dark coffee-bg">
            <div class="container">
                <div class="sub-title"></div>
                <h2>Usa nuestro foro</h2>
                <div class="content">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 omega">
                            <div class="media">
                                <span class="pull-left">
                                    <i class="fa fa-slideshare fa-3x"></i>
                                </span>
                                <div class="media-body">
                                    <h4 class="media-heading" style="font-weight: 600;">¿Tienes algo interesante que compartir?</h4>
                                    <p>Crea un post en el foro y compartelo con el resto de estudiantes como tú.</p>
                                </div>
                            </div>
                            <div class="media">
                                <span class="pull-left">
                                    <i class="fa fa-comments fa-3x"></i>
                                </span>
                                <div class="media-body">
                                    <h4 class="media-heading" style="font-weight: 600;">¿Alguna duda?</h4>
                                    <p>Crea un post en el foro, ¡Nuestros tutores u otro alumno podrian ayudarte!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="light pb-0" >
            <div class="container">
                <h2 style="margin-bottom: 0px">Atención personalizada</h2>
                <div class="row">
                    <div class="col-sm-6 mt-3">
                        <div class="design-holder mt-5">
                            <img src="/img/background/teacher.jpg" alt="design Iphone" class="img-responsive teacherHome"> 
                        </div>
                    </div>
                    <div class="col-sm-6 alpha pull-left mt-5">  
                        <div class="content mt-3">
                            <div class="row">
                                <div class="col-md-12 col-sm-5 alpha omega">
                                    <div class="media-body" style="text-align: right">
                                        <h4 class="media-heading" style="font-weight: 600;">¿Quieres una atención personalizada?</h4>
                                        <p>Usa nuestro chat para un contacto directo con nuestros tutores. <br>¡Te resolveran cualquier duda!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mx-auto">
                                    <img src="/img/background/chat.png" alt="expand" class="img-responsive" height="300px" style="padding-left: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <section class="dark responsive-section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-7 alpha pull-right">
                            <div class="sub-title text-left"></div>
                            <h2 class="text-left">Diseño responsive</h2>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-4 col-sm-5">
                                        <img src="/img/media/frame-check.png" alt="check" class="img-responsive" >
                                    </div>
                                    <div class="col-md-8 col-sm-7 alpha omega">
                                        <div class="medium-title">En cualquier lugar</div>
                                        <p class="white">Nunca pares de aprender, no importa el lugar.</p>
                                    </div>
                                </div>
                                <div class="gap"></div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-5">
                                        <img src="/img/media/frame-expand.png" alt="expand" class="img-responsive">
                                    </div>
                                    <div class="col-md-8 col-sm-7 alpha omega">
                                        <div class="medium-title">¿Ordenador, tablet o movil?</div>
                                        <p class="white">Con nuestro diseño, podras tenernos en cualquier dispositivo.</p>
                                    </div>
                                </div>
                                <div class="gap"></div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="design-holder">
                                <img src="/img/media/Reponsive.png" alt="design Iphone" class="img-responsive" style="height:500px"> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="test-num">
                    <div class="container">
                        <div class="row column-12">
                            @foreach($problems = App\ProblemType::with('problems')->get() as $problem)
                            <div class="col-sm-3">
                                <div >
                                    
                                    <div class="nmbr-counter stat"><span class="value" data-from="0" data-to="750">{{$problem->problems->count()}}</span></div>
                                    <div class="caption">{{$problem->type}}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>
    

        <section class="dark world-bg" id="contact">
                <div class="container mb-5">
                    <div class="sub-title">Ponte en contacto</div>
                    <h2>¡Nos encanta el feedback!</h2>
                    <div class="content contact-us">
                        <div class="col-sm-12">
                            <form action="{{route('contact')}}" method="post" accept-charset="utf-8" id="contact-form" role="form" data-toggle="validator">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input type="email" name="email" id="input-email" class="form-control"  required="required" placeholder="Email*" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="subject" id="input-subject" class="form-control"  required="required" placeholder="Asunto*" />
                                            <input name="contact" value="1" hidden>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <textarea name="message" id="textarea-message" class="form-control" rows="3" required placeholder="Mensaje*"></textarea>
                                            </div>
                                        </div>
                                        <button type="submit">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
    </div>

    
@endsection
