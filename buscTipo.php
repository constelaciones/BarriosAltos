<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <div id="buscTipo">    
          <form>
            <h4>Buscar por tipo de archivo</h4>            
            <img src="images/icono_foto.png" />
            <input id="foto" type="radio" name="selectedRadio" value= '0' onclick="buscTipo(this.value)">Foto
            <img src="images/icono_video.png" />
            <input id="video" type ="Radio" name ="selectedRadio" value= '1' onclick="buscTipo(this.value)">Video
            <img src="images/icono_texto.png" />
            <input id="texto" type="Radio" name="selectedRadio" value= '2' onclick="buscTipo(this.value)">Texto
            <img src="images/icono_audio.png" />
            <input id="audio" type="Radio" name="selectedRadio" value= '3' onclick="buscTipo(this.value)">Audio
        </form>
    </div>
<div id="resultadosTipo"></div>
    