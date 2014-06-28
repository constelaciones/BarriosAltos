function showRegistro(str)
    {
    if (str=="")
      {
      document.getElementById("registrado").innerHTML="";
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
        document.getElementById("registrado").innerHTML=xmlhttp.responseText;
        }
      }
      var namevalue=encodeURIComponent(document.getElementById("username").value)
    var pass=encodeURIComponent(document.getElementById("pass").value)
    var clave2value=encodeURIComponent(document.getElementById("clave2").value)
    var mailvalue=encodeURIComponent(document.getElementById("mail").value)
    xmlhttp.open("GET","registrar.php?username="+namevalue+"&pass="+pass+"&clave2="+clave2value+"&mail="+mailvalue, true);
    //console.log(namevalue+"nombre");
    //console.log(pass+"clave");
    //console.log(clave2value+"clave2");
    //console.log(mailvalue+"mail");
    //xmlhttp.open("GET","validar_usuario.php?nombre="+document.getElementById('nombre').value"&clave="document.getElementById('clave').value, true);
    xmlhttp.send();
    
}