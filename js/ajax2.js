/********************************************************************************************/
/* AJAX Simple Tabs by developersnippets, This code is intended for practice purposes.      */
/* You may use these functions as you wish, for commercial or non-commercial applications,  */
/* but please note that the author offers no guarantees to their usefulness, suitability or */
/* correctness, and accepts no liability for any losses caused by their use.                */
/********************************************************************************************/

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
function activeTab(tab)
	{   
		document.getElementById("tab1").className = "";
		document.getElementById("tab2").className = "";
		document.getElementById("tab3").className = "";
                document.getElementById("tab4").className = "";
		document.getElementById("tab5").className = "";
		document.getElementById("tab"+tab).className = "active";
                
                switch("tab"+tab){
                
                case "tab1":
		callPage('lista.php', 'content', '<img src="images/loading.gif" /> Content is loading, Please Wait...', 'Error in Loading page <img src="images/error_caution.gif" />');
                break;
                
		case "tab2":
		callPage('buscTipo.php', 'content', '<img src="images/loading.gif" /> Content is loading, Please Wait...', 'Error in Loading page <img src="images/error_caution.gif" />');
                break;
                
                
                case "tab3":
                callPage('buscTag.php', 'content', '<img src="images/loading.gif" /> Content is loading, Please Wait...', 'Error in Loading page <img src="images/error_caution.gif" />');
                break;
                
                case "tab4":
                callPage('buscUsuario.php', 'content', '<img src="images/loading.gif" /> Content is loading, Please Wait...', 'Error in Loading page <img src="images/error_caution.gif" />');
                break;
                
                case "tab5":
                callPage('buscFecha.php', 'content', '<img src="images/loading.gif" /> Content is loading, Please Wait...', 'Error in Loading page <img src="images/error_caution.gif" />');
                break;
                
                
                }
        }