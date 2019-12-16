$(document).ready(function() {
    $("form").submit(function() {
        $(this)
            .find("button[type='submit']")
            .prop("disabled", true)
            .html("<i class='fa fa-spinner fa-spin fa-2x'></i>");
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

    $(".confirmar-reinicio").on("click", function(e) {
        e.preventDefault();
        var form = $(this).parents("form");
        swal(
            {
                title: "¿Estás seguro?",
                text:
                    "La marca de pago de todos los alumnos se pondran a NO PAGADO. \n Esta acción no afecta a los pagos realizados.",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Reiniciar",
                closeOnConfirm: false
            },
            function(isConfirm) {
                if (isConfirm) form.submit();
            }
        );
    });

    $(".multiselect").multiselect({
        search: {
            left:
                '<input type="text" name="q" class="form-control my-1" placeholder="Buscar..." />',
            right:
                '<input type="text" name="q" class="form-control my-1" placeholder="Buscar..." />'
        },
        fireSearch: function(value) {
            return value.length > 1;
        }
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

    var table2 = $("#dataTable2").DataTable({
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
