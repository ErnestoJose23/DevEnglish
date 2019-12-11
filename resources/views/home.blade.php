@extends('layouts.app')

@section('content')
<div id="hero" class="dark">
      
        <div id="carousel-item" class="carousel slide" data-ride="carousel">
           
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/img/Slides/Slide1.jpg" alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <div class="heading-image"><img src="/img/media/hero-image-heading.png" alt=""></div>
                            <div class="sub-title">Welcome to</div>
                            <h1>DevEnglish</h1>
                            <div class="footer-image"><img src="/img/media/hero-line.png" alt=""></div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/img/Slides/Slide.jpg" alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <div class="heading-image"><img src="/img/media/hero-image-heading.png" alt=""></div>
                            <div class="sub-title">Next Wordpress theme generation</div>
                            <h1>Develop your english</h1>
                            <div class="footer-image"><img src="/img/media/hero-line.png" alt=""></div>
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
                <div class="sub-title">DevEnglish</div>
                <h2>¿Qué hacer?</h2>
                <div class="content">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img src="/img/media/polygon-1.png" alt="Polygon 1">
                                <div class="caption">
                                    <h4>Suscribete a nuestros temarios</h4>
                                    <p>Quisque lacinia vulputate neque eu scelerisque. Ut sollicitudin enim non laoreet feugiat. Maecenas at urna sem.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img src="/img/media/polygon-1.png" alt="Polygon 1">
                                <div class="caption">
                                    <h4>Recopila informacion</h4>
                                    <p>Quisque lacinia vulputate neque eu scelerisque. Ut sollicitudin enim non laoreet feugiat. Maecenas at urna sem.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img src="/img/media/polygon-2.png" alt="Polygon 2">
                                <div class="caption">
                                    <h4>Pon a prueba tus conocimientos</h4>
                                    <p>Quisque lacinia vulputate neque eu scelerisque. Ut sollicitudin enim non laoreet feugiat. Maecenas at urna sem.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img src="/img/media/polygon-3.png" alt="Polygon 3">
                                <div class="caption">
                                    <h4>Visualiza tu progreso</h4>
                                    <p>Quisque lacinia vulputate neque eu scelerisque. Ut sollicitudin enim non laoreet feugiat. Maecenas at urna sem.</p>
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
                                <img src="/img/media/wireframe-iphone.png" alt="design Iphone" class="img-responsive" style="height:500px"> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="test-num">
                    <div class="container">
                        <div class="row column-12">
                            <div class="col-sm-3">
                                <div >
                                    <div class="icon-holder"><img src="/img/icon/white-cup.png" alt="white icon"></div>
                                    <div class="nmbr-counter stat"><span class="value" data-from="0" data-to="750">{{App\Problem::tests()->count()}}</span></div>
                                    <div class="caption">Tests</div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div>
                                    <div class="icon-holder"><img src="/img/icon/white-discussion.png" alt="white icon"></div>
                                    <div class="nmbr-counter stat"><span class="value" data-from="0" data-to="5678">{{App\Problem::listenings()->count()}}</span></div>
                                    <div class="caption">Listenings</div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div>
                                    <div class="icon-holder"><img src="/img/icon/white-smile.png" alt="white icon"></div>
                                    <div class="nmbr-counter stat"><span class="value" data-from="0" data-to="178">{{App\Problem::rellenarhuecos()->count()}}</span></div>
                                    <div class="caption">Rellenar Huecos</div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div>
                                    <div class="icon-holder"><img src="/img/icon/white-discussion.png" alt="white icon"></div>
                                    <div class="nmbr-counter stat"><span class="value" data-from="0" data-to="5678">{{App\Problem::fallos()->count()}}</span></div>
                                    <div class="caption">Encuentra el fallo</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
    

        <section class="dark world-bg" id="contact">
                <div class="container">
                    <div class="sub-title">Ponte en contacto</div>
                    <h2>¡Nos encanta el feedback!</h2>
                    <div class="content contact-us">
                      
                        <div class="col-sm-12">
                            <form action="http://www.magictemplates.nl/Solid-01/contact.php" method="post" accept-charset="utf-8" id="contact-form" role="form" data-toggle="validator">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input type="text" name="name" id="input-name" class="form-control"  required="required" placeholder="Nombre*" />
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" id="input-email" class="form-control"  required="required" placeholder="Email*" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="subject" id="input-subject" class="form-control"  required="required" placeholder="Asunto*" />
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
            </section>
    </div>

    
@endsection
