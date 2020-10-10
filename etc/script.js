function class_render (id_class) {
    $("#contenido").empty();
        $.ajax({
            type: "POST",
            url: "../funciones_e/get_class.php",
            data: { id_class },

            success: function(srvr_response) {
                $("#contenido").html(srvr_response);
            },
        });
    }
