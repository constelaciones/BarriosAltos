function showUsers(str)
{
    console.log($("#resultadosUsuario"));
    
            $.get("bUsuario.php?q="+str, function(data) {
              $("#resultadosUsuario").html(data);
              });
              }
              
              
function showUsersRuta(str)
{
    console.log($("#resultadosUsuarioRuta"));
    
            $.get("bUsuarioRuta.php?q="+str, function(data) {
              $("#resultadosUsuarioRuta").html(data);
              });
    /*
if (str=="")
  {
  document.getElementById("resultadosUsuario").innerHTML="";
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
    document.getElementById("resultadosUsuario").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","bUsuario.php?q="+str,true);
xmlhttp.send();
*/

}