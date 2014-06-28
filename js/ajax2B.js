        var req;
function callPage(pageUrl, divElementId, loadinglMessage, pageErrorMessage) {
     document.getElementById(divElementId).innerHTML = loadinglMessage;
     try {
     req = new XMLHttpRequest(); /* e.g. Firefox */
     } catch(e) {
       try {
       req = new ActiveXObject("Msxml2.XMLHTTP");  /* some versions IE */
       } catch (e) {
         try {
         req = new ActiveXObject("Microsoft.XMLHTTP");  /* some versions IE */
         } catch (E) {
          req = false;
         } 
       } 
     }
     req.onreadystatechange = function() {responsefromServer(divElementId, pageErrorMessage);};
     req.open("GET",pageUrl,true);
     req.send(null);
  }

function responsefromServer(divElementId, pageErrorMessage) {
   var output = '';
   if(req.readyState == 4) {
      if(req.status == 200) {
         output = req.responseText;
         document.getElementById(divElementId).innerHTML = output;
         } else {
         document.getElementById(divElementId).innerHTML = pageErrorMessage+"\n"+output;
         }
      }
  }
  
/* This Function is for Tab Panels */
function activeTabB(tab)
	{   
		document.getElementById("tab7").className = "";
		document.getElementById("tab8").className = "";
		document.getElementById("tab9").className = "";
		document.getElementById("tab"+tab).className = "active";
                
                switch("tab"+tab){
        
                case "tab7":
                callPage('listaRutas.php', 'contentB', '<img src="images/loading.gif" /> Content is loading, Please Wait...', 'Error in Loading page <img src="images/error_caution.gif" />');
                break;
                
                case "tab8":
                callPage('buscUsuarioRuta.php', 'contentB', '<img src="images/loading.gif" /> Content is loading, Please Wait...', 'Error in Loading page <img src="images/error_caution.gif" />');
                break;
                
                case "tab9":
                callPage('buscFechaRuta.php', 'contentB', '<img src="images/loading.gif" /> Content is loading, Please Wait...', 'Error in Loading page <img src="images/error_caution.gif" />');
                break;
                
                
                }
        }