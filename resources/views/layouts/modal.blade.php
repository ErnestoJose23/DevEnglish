<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content answerModal">
            <div class="modal-header" style="background-color: #1a293a; color:white">
                <h5 class="col-12 modal-title text-center" id="exampleModalLabel">Puntuación</h5>
                </button>
            </div>
            <div class="modal-body col-12 text-center answermodal" style="background-color: white !important"> 
                <h2 id="anscorrect"></h2> 
                <h5 id="perfect" style="color: #4bda4b; margin-bottom: 20px;"></h5> 
            </div>
            <div class="modal-footer" style="justify-content: center; background-color: #1a293a;">
                <a type="button" href="" class="btn btn-light" onClick="window.location.reload();"  style="text-transform: none;">Vuelve a intentarlo</a>
                <a type="button" href="" class="btn btn-light" onclick="window.history.go(-1); return false;"  style="text-transform: none;">Lista de pruebas</a>
                <a type="button" href="{{ route('usuario.show', Auth::user())}}" class="btn btn-light" style="text-transform: none;">Mi progreso</a>
            </div>
        </div>
    </div>
</div>