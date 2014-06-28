<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div id="buscador por area">    
        <form id="buscador_por_Area" action="buscArea.php" method="post">
            <h4>Buscar por temática</h4>
            <select name="areas" onclick="showArea(this.value)">
            <option value="">Selecciona Área:</option>
            <option value="Urbanismo" >Urbanismo</option>
            <option value="Arquitectura">Arquitectura</option>
            <option value="Espacios">Espacios</option>
            <option value="Lugares">Lugares</option>
            <option value="Intervención pública">Intervención pública</option>
            </select>
        </form>
    <div id="resultadosArea"></div>
</div>