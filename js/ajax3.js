function showLogin(str)
    {
    if (str=="")
      {
      document.getElementById("txtValidar").innerHTML="";
      return;
      } 
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        document.getElementById("txtValidar").innerHTML=xmlhttp.responseText;
        }
      }
      var namevalue=encodeURIComponent(document.getElementById("nombre").value)
    var clavevalue=encodeURIComponent(document.getElementById("clave").value)
    xmlhttp.open("GET","validar_usuario.php?nombre="+namevalue+"&clave="+clavevalue, true);
    //xmlhttp.open("GET","validar_usuario.php?nombre="+document.getElementById('nombre').value"&clave="document.getElementById('clave').value, true);
    xmlhttp.send();
}
