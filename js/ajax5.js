function showArea(str)
{
   console.log($("#resultadosArea"));
    
    $.get("buscArea.php?q="+str, function(data) {
      $("#resultadosArea").html(data);
      }); 
/*
if (str=="")
  {
  document.getElementById("resultadosArea").innerHTML="";
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
    document.getElementById("resultadosArea").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","buscArea.php?q="+str,true);
xmlhttp.send();
*/
}