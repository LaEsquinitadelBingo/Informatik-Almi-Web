document.getElementById("productoSelect").addEventListener("change", function () {
    var selectedOption = this.value;
    var camposExtra = document.getElementById("camposExtra");
    // Limpiar campos existentes
    camposExtra.innerHTML = '';
    // Crear campos adicionales dependiendo de la opción seleccionada
    switch (selectedOption) {
        case 'CPU':
            camposExtra.innerHTML = `
                <div>
                    <label for="frecuencia">Frecuencia:</label>
                    <input type="number" id="frecuencia" name="frecuencia">
                </div>
                <div>
                    <label for="consumo">Consumo:</label>
                    <input type="number" id="consumo" name="consumo">
                </div>
                <div>
                    <label for="nucleos">Nucleos:</label>
                    <input type="number" id="nucleos" name="nucleos">
                </div>                            
            `;
            break;
        case 'RAM':
            camposExtra.innerHTML = `
            <div>
                <label for="frecuencia">Frecuencia:</label>
                <input type="number" id="frecuencia" name="frecuencia">
            </div>
            <div>
                <label for="generacion">Generación:</label>
                <input type="text" id="generacion" name="generacion">
            </div>
            <div>
                <label for="tamano">Tamaño:</label>
                <input type="number" id="tamano" name="tamano">
            </div>            
            `;
            break;
        case 'placa_base':
                camposExtra.innerHTML = `
               
                <div>
                    <label for="grafica">Gráfica:</label>
                    <input type="number" id="grafica" name="grafica" min="0" max="1" step="1" placeholder="1 para sí, 0 para no">

                </div>
                <div>
                    <label for="tamano">Tamaño:</label>
                    <input type="text" id="tamano" name="tamano">
                </div>                 
                `;
            break;
        case 'tarjeta_grafica':
                    camposExtra.innerHTML = `
                <div>
                    <label for="puertos_video">Puertos video:</label>
                    <input type="number" id="puertos_video" name="puertos_video">
                </div>
                <div>
                    <label for="consumo">Consumo:</label>
                    <input type="number" id="consumo" name="consumo">
                </div>
                <div>
                    <label for="capacidad">Capacidad:</label>
                    <input type="number" id="capacidad" name="capacidad">
                </div>                   
                `;
            break;
        case 'fuente_alimentacion':
                camposExtra.innerHTML = `
            <div>
                <label for="modular">Modular:</label>
                <input type="number" id="modular" name="modular" min="0" max="1" step="1" placeholder="1 para sí, 0 para no">

            </div>
          
            <div>
                <label for="capacidad">Capacidad:</label>
                <input type="number" id="capacidad" name="capacidad">
            </div>              
            `;
            break;
        case 'ventilador':
                camposExtra.innerHTML = `
           
            <div>
                <label for="tamano">Tamaño:</label>
                <input type="number" id="tamano" name="tamano">
            </div>               
            `;
            break;
        case 'caja':
                camposExtra.innerHTML = `
            <div>
                <label for="dimesion">Dimensión:</label>
                <input type="text" id="dimesion" name="dimension">
            </div>                          
            `;
            break;
        case 'pantalla':
                camposExtra.innerHTML = `
            <div>
                <label for="puertos_video">Puertos vídeo:</label>
                <input type="number" id="puertos_video" name="puertos_video">
            </div>
            <div>
                <label for="dimension">Dimensión:</label>
                <input type="text" id="dimension" name="dimension">
            </div> 
            <div>
                <label for="tasa_refresco">Tasa refresco:</label>
                <input type="number" id="tasa_refresco" name="tasa_refresco">
            </div>                   
            `;
            break;
        case 'teclado':
                camposExtra.innerHTML = `
            <div>
                <label for="distribucion">Distribución:</label>
                <input type="text" id="distribucion" name="distribucion">
            </div>
            <div>
                <label for="peso">Peso:</label>
                <input type="number" id="peso" name="peso">
            </div> 
            <div>
                <label for="inalanbrico">Inalánbrico:</label>
                <input type="number" id="inalanbrico" name="inalambrico" min="0" max="1" step="1" placeholder="1 para sí, 0 para no">
            </div>                   
            `;
            break;
        case 'raton':
                camposExtra.innerHTML = `
            <div>
                <label for="peso">Peso:</label>
                <input type="number" id="peso" name="peso">
            </div> 
            <div>
                <label for="inalambrico">Inalámbrico:</label>
                <input type="number" id="inalambrico" name="inalambrico" min="0" max="1" step="1" placeholder="1 para sí, 0 para no">
            </div>                   
            `;
            break;
        case 'cascos':
                camposExtra.innerHTML = `
            <div>
                <label for="microfono">Micrófono:</label>
                <input type="number" id="microfono" name="microfono" min="0" max="1" step="1" placeholder="1 para sí, 0 para no">
            </div>
            <div>
                <label for="cancelacion_ruido">Cancelación ruido:</label>
                <input type="number" id="cancelacion_ruido" name="cancelacion_ruido" min="0" max="1" step="1" placeholder="1 para sí, 0 para no">
            </div> 
            <div>
                <label for="inalambrico">Inalámbrico:</label>
                <input type="number" id="inalambrico" name="inalambrico" min="0" max="1" step="1" placeholder="1 para sí, 0 para no">
            </div>                   
            `;
            break;
        case 'disco_duro':
                camposExtra.innerHTML = `
            <div>
                <label for="almacenamiento">Almacenamiento:</label>
                <input type="number" id="almacenamiento" name="almacenamiento">
            </div>
            <div>
                <label for="velocidad">Velocidad:</label>
                <input type="number" id="velocidad" name="velocidad">
            </div> 
            <div>
                <label for="peso">Peso:</label>
                <input type="number" id="peso" name="peso">
            </div>                   
            `;
            break;
        case 'portatil':
                camposExtra.innerHTML = `
            <div>
                <label for="tamano">Tamaño:</label>
                <input type="number" id="tamano" name="tamano">
            </div>
            <div>
                <label for="ram">Ram:</label>
                <input type="text" id="ram" name="ram">
            </div> 
            <div>
                <label for="grafica">Gráfica:</label>
                <input type="text" id="grafica" name="grafica">
            </div> 
            <div>
                <label for="procesador">Procesador:</label>
                <input type="text" id="procesador" name="procesador">
            </div>                     
            `;
            break;
        default:
            break;
    }
});