$(document).ready(function() {
    $("body").on("click", ".btn-danger", function() {
        $(this)
            .parents(".control-group")
            .remove();
    });
    $("#myModal").on("shown.bs.modal", function() {
        $("#myModal").modal("show");
    });
});

$(".incrementar").click(function() {
    var html = $(".clone").html();
    $(".increment").after(html);
});

$(document).ready(function() {
    $(document).ready(function() {
        $("#topChat").click(function() {
            $("#chat").animate({ scrollTop: "0px" });
        });
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

$(".confirmar-borrado").on("click", function(e) {
    e.preventDefault();
    var form = $(this).parents("form");
    swal(
        {
            title: "¿Estás seguro?",
            text: "El elemento se borrará",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Borrar",
            closeOnConfirm: false
        },
        function(isConfirm) {
            if (isConfirm) form.submit();
        }
    );
});

$(function() {
    $('[data-toggle="tooltip"]').tooltip();
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
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
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

(function($) {
    "use strict"; // Start of use strict

    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on("click", function(e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $(".sidebar .collapse").collapse("hide");
        }
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function() {
        if ($(window).width() < 768) {
            $(".sidebar .collapse").collapse("hide");
        }
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel", function(
        e
    ) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on("scroll", function() {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $(".scroll-to-top").fadeIn();
        } else {
            $(".scroll-to-top").fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on("click", "a.scroll-to-top", function(e) {
        var $anchor = $(this);
        $("html, body")
            .stop()
            .animate(
                {
                    scrollTop: $($anchor.attr("href")).offset().top
                },
                1000,
                "easeInOutExpo"
            );
        e.preventDefault();
    });
})(jQuery); // End of use strict
