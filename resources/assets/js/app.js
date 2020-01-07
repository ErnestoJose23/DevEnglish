$(document).ready(function() {
    $(document).ready(function() {
        $("#topChat").click(function() {
            $("#chat").animate({ scrollTop: "0px" });
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
                closeOnConfirm: false
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
        var anscorrect = 0;
        for (i = 0; i < cont; i++) {
            if ($("#option" + (i + 1)).val() == $("#answer" + (i + 1)).val())
                anscorrect = anscorrect + 1;
        }
        var questions = $("input[name=questions]").val();
        var problem_id = $("input[name=problem_id]").val();
        var user_id = $("input[name=user_id]").val();
        var correct = anscorrect;
        if (anscorrect == cont) {
            document.getElementById("perfect").innerHTML =
                "¡Enhorabuena, tu puntuación ha sido perfecta!";
        }
        document.getElementById("anscorrect").innerHTML =
            anscorrect + " / " + cont;
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        $.ajax({
            type: "POST",
            url: "/test/resultado",
            data: {
                questions: questions,
                problem_id: problem_id,
                user_id: user_id,
                correct: correct
            },
            success: function(data) {
                $("#modal").modal("show");
            }
        });
    });

    $("#submitformTest").click(function(e) {
        e.preventDefault();
        var anscorrect = 0;
        $.each($("input[type='radio']:checked"), function() {
            if ($(this).val() == 1) {
                anscorrect = anscorrect + 1;
            }
        });
        var questions = $("input[name=questions]").val();
        var problem_id = $("input[name=problem_id]").val();
        var user_id = $("input[name=user_id]").val();
        var correct = anscorrect;
        if (anscorrect == cont) {
            document.getElementById("perfect").innerHTML =
                "¡Enhorabuena, tu puntuación ha sido perfecta!";
        }
        document.getElementById("anscorrect").innerHTML =
            anscorrect + " / " + cont;
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        $.ajax({
            type: "POST",
            url: "/test/resultado",
            data: {
                questions: questions,
                problem_id: problem_id,
                user_id: user_id,
                correct: correct
            },
            success: function(data) {
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
        $.ajax({
            type: "POST",
            url: "/message",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (userimg == "") userimg = "defaultUser.jpg";
                if (response.img != null) {
                    imagen =
                        "<img src='/uploads/media/" +
                        response.img +
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
});
