function PasarNombreRuta(valorNombreRuta){
    var parametro = {
        "valorNombreRuta" : valorNombreRuta
        };
        $.ajax({
            data:  parametro,
            url:   'verRuta.php',
            type:  'POST',
            
            success:  function (response) {
                $("#ruta").html(response);
            }
        });
}