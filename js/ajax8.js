function showFecha(str)
{
    console.log($("#resultadosFecha"));
    
            $.get("bFecha.php?fecha="+str, function(data) {
              $("#resultadosFecha").html(data);
              });
              }
              
function showFechaRuta(str)
{
    console.log($("#resultadosFechaRuta"));
    
            $.get("bFechaRuta.php?fecha="+str, function(data) {
              $("#resultadosFechaRuta").html(data);
              });
    /*
if (str=="")
  {
  document.getElementById("resultadosFecha").innerHTML="";
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
    document.getElementById("resultadosFecha").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","bFecha.php?fecha="+str,true);
xmlhttp.send();
*/
}