jQuery(document).ready(function() {
    var btn = $("#gotop");
    btn.on("click", function(e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "600");
    });
});

$(document).ready(function() {
    $(document).ready(function() {
        $("#topChat").click(function() {
            $("#chat").animate({ scrollTop: "0px" });
        });
    });
});
$(".confirmar-cancelacion").on("click", function(e) {
    e.preventDefault();
    var form = $(this).parents("form");
    swal(
        {
            title: "¿Estás seguro?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cerrar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Cancelar suscripción",
            preConfirm: false
        },
        function(isConfirm) {
            if (isConfirm) form.submit();
        }
    );
});

$(".incrementar").click(function() {
    var html = $(".clone").html();
    $(".increment").after(html);
});

$("body").on("click", ".btn-danger", function() {
    $(this)
        .parents(".control-group")
        .remove();
});

$("#submitformHueco").click(function(e) {
    e.preventDefault();
    var right = 0;
    for (i = 0; i < cont; i++) {
        if ($("#option" + (i + 1)).val() == answer[i]) right = right + 1;
    }
    var problem_id = $("input[name=problem_id]").val();
    var topic_id = $("input[name=topic_id]").val();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        type: "POST",
        url: "/test/resultado",
        data: {
            cont: cont,
            right: right,
            problem_id: problem_id,
            topic_id: topic_id
        },
        success: function(response) {
            if (response.grade == 100) {
                document.getElementById("perfect").innerHTML =
                    "¡Enhorabuena, tu puntuación ha sido perfecta!";
            }
            document.getElementById("grade").innerHTML = response.grade + "%";
            document.getElementById("anscorrect").innerHTML =
                right + " / " + cont;
            $("#modal").modal("show");
        }
    });
});

$("#submitformTest").click(function(e) {
    e.preventDefault();
    var right = 0;
    $.each($("input[type='radio']:checked"), function() {
        if ($(this).val() == 1) {
            right = right + 1;
        }
    });

    var problem_id = $("input[name=problem_id]").val();
    var topic_id = $("input[name=topic_id]").val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        type: "POST",
        url: "/test/resultado",
        data: {
            cont: cont,
            right: right,
            problem_id: problem_id,
            topic_id: topic_id
        },
        success: function(response) {
            if (response.grade == 100) {
                document.getElementById("perfect").innerHTML =
                    "¡Enhorabuena, tu puntuación ha sido perfecta!";
            }
            document.getElementById("grade").innerHTML = response.grade + "%";
            document.getElementById("anscorrect").innerHTML =
                right + " / " + cont;
            $("#modal").modal("show");
        }
    });
});

$("#messageForm").submit(function(e) {
    event.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    var formData = new FormData(this);

    Pusher.logToConsole = true;

    var pusher = new Pusher("2552a5d3c8c00d550060", {
        cluster: "eu",
        forceTLS: true
    });

    var channel = pusher.subscribe("my-channel");
    channel.bind("my-event", function(data) {
        alert(JSON.stringify(data));
    });

    $.ajax({
        type: "POST",
        url: "/message",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
            if (userimg == "") userimg = "defaultUser.jpg";
            if (response.image != null) {
                imagen =
                    "<img src='/uploads/media/" +
                    response.image +
                    "' width='50%'>";
            } else imagen = "";
            if (response.content == null) response.content = " ";
            respuesta =
                " <div class='msg right-msg'> <div class='msg-img' style='background-image: url(/uploads/media/" +
                userimg +
                ")''></div> <div class='msg-bubble'><div class='msg-info'><div class='msg-info-name'>" +
                username +
                "</div><div class='msg-info-time'>" +
                response.created_at +
                "</div></div><div class='msg-text'><p>" +
                response.content +
                "</p>" +
                imagen +
                "</div></div></div>";
            $("#chat").append(respuesta);
            objDiv.scrollTop = objDiv.scrollHeight;
            document.getElementById("messageForm").reset();
        }
    });
});

jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
    var table = $("#dataTable").DataTable({
        responsive: true,
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo:
                "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty:
                "Mostrando registros del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
            sUrl: "",
            sInfoThousands: ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior"
            },
            oAria: {
                sSortAscending:
                    ": Activar para ordenar la columna de manera ascendente",
                sSortDescending:
                    ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
});
