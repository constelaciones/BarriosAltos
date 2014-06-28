$(document).ready(function() {
        $(".ver_login").click(verLogin);
});

function verLogin() {
        var url=$(this).attr("href");
        var $contenedor= "#mostrar";
        $contenedor.load(url);
        return false;
}