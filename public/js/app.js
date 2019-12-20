$(document).ready(function() {

    $(document).ready(function() {
        $("#topChat").click(function() {
            $("#chat").animate({ scrollTop: "0px" });
        });
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
});
