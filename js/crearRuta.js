function busquedaRuta(str)
{
if (str=="")
  {
  document.getElementById("ruta").innerHTML="";
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
    document.getElementById("ruta").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","verRuta.php?nombre_ruta="+str,true);
xmlhttp.send();
}