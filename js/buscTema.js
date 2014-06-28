    $(document).ready(function() {
    $('#form, #fat, #buscadorTema').submit(function() {
        console.log($("form#buscadorTema"));
        console.log($("form#buscadorTema").serialize());

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                $('#txtHint').html(data);
            }
        });

        return false;
    });
});