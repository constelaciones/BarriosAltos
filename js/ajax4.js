function buscTipo(int)
{
    console.log($("#resultadosTipo"));
    
    $.get("btipo.php?selectedRadio="+int, function(data) {
      $("#resultadosTipo").html(data);
      });
    /*
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
    document.getElementById("capa").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","bTipo.php?selectedRadio="+int,true);
xmlhttp.send();
*/
}