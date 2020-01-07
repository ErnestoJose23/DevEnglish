@extends('layouts.app')

@section('content')
<div id="main">
        <section class="light" id="blog">
                <div class="container mt-5">
                        <h2> Terms & Resources</h2>
                        <div class="row">
                                <div class="col-3">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Terms</a>
                                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Links</a>
                                                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Videos</a>
                                        </div>
                                </div>
                                <div class="col-9" style="background-color: #8080800f;">
                                        <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" style="text-align: left">
                                                        @foreach($terms as $term)
                                                        <div class="row">
                                                                
                                                                <h5 class="mt-3 ml-2">
                                                                        - {{$term->term}} \{{$term->afi}} \  <a href="#"  class="say ml-2" data-term="{{$term->term}}"><i class="fa fa-volume-up"></i></a> :
                                                                </h5>
                                                                <audio src="" class="speech" hidden></audio>
                                                                <div class="mt-3" style="font-size:15px"> {{$term->definition}}</div>
                                                        </div>
                                                        @endforeach
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" style="text-align: left">
                                                        @foreach($links as $link)
                                                        <a href="{{$link->url}}" target="_blank">
                                                                <h5 class="mt-3 ml-2">
                                                                        {{$link->title}}
                                                                </h5>
                                                                <p class="ml-5" style="font-size:15px">{{$link->descp}}</p>
                                                        </a>
                                                        @endforeach
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" style="text-align: left">
                                                        @foreach($videos as $video)
                                                        <a href="{{$video->url}}" target="_blank">
                                                                <h5 class="mt-3 ml-2">
                                                                        {{$video->title}}
                                                                </h5>
                                                                <p class="ml-5" style="font-size:15px">{{$video->descp}}</p>
                                                        </a>
                                                        @endforeach
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
                <select id="voices" hidden ></select>
        </section>
</div>

<script>

        $(function(){
                if ('speechSynthesis' in window) {
                speechSynthesis.onvoiceschanged = function() {
                var $voicelist = $('#voices');

                if($voicelist.find('option').length == 0) {
                        var cont = 0;
                        speechSynthesis.getVoices().forEach(function(voice, index) {
                                cont ++;
                                if(cont == 5){
                                        var $option = $('<option selected>')
                                        .val(index)
                                        .html(voice.name + (voice.default ? ' (default)' :''));
                                        }else{
                                                var $option = $('<option>')
                                                .val(index)
                                                .html(voice.name + (voice.default ? ' (default)' :''));
                                        }
                                $voicelist.append($option);
                        });

                        $voicelist.material_select();
                }
                }

                $('a.say').click(function(){
                var text = $(this).data("term");
                var msg = new SpeechSynthesisUtterance();
                var voices = window.speechSynthesis.getVoices();
                msg.voice = voices[$('#voices').val()];
                msg.rate = 1;
                msg.pitch = 1;
                msg.text = text;
                console.log(voices[$('#voices').val()]);
                msg.onend = function(e) {
                        console.log('Finished in ' + event.elapsedTime + ' seconds.');
                };

                speechSynthesis.speak(msg);
                })
                } else {
                $('#modal1').openModal();
                }
        });
</script>

@endsection