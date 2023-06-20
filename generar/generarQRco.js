function generarCodigosQR() {
    var selectElement = document.getElementById("cargoSelect");
    var cargoSeleccionada = selectElement.value;

    if (cargoSeleccionada === "") {
      return; // No se ha seleccionado una cargo, no hacer nada
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var datos = JSON.parse(xhr.responseText);
        var modalBody = document.getElementById("modalBody");
        modalBody.innerHTML = ""; // Limpiar el contenido del modal antes de generar los nuevos

        for (var i = 0; i < datos.length; i++) {
          var codigo = datos[i].documento;
          var nombre = datos[i].nombre;
          var nombrecargo = datos[i].cargo;

          var carne = document.createElement("div");
          carne.className = "carne";

          var nombreElement = document.createElement("p");
          nombreElement.className = "nombre";
          nombreElement.textContent = nombre;
          carne.appendChild(nombreElement);

          var documentoElement = document.createElement("p");
          documentoElement.className = "documento";
          documentoElement.textContent = "documento: " + codigo;
          carne.appendChild(documentoElement);

          var cargoElement = document.createElement("p");
          cargoElement.className = "cargo";
          cargoElement.textContent = "cargo: " + nombrecargo;
          carne.appendChild(cargoElement);

          var qrElement = document.createElement("div");
          qrElement.className = "codigo-qr";
          carne.appendChild(qrElement);

          var qrCode = new QRCode(qrElement, {
            text: codigo,
            width: 128,
            height: 128
          });

          modalBody.appendChild(carne);
        }

        // Mostrar el modal
        $('#modalCodigosQR').modal('show');
      }
    };

    // Realizar la consulta a la base de datos para obtener los datos de los estudiantes por cargo
    var url = "./obtener/obtener_datosColaboradores.php?cargo=" + encodeURIComponent(cargoSeleccionada);
    xhr.open("GET", url, true);
    xhr.send();
  }
  function imprimirCodigosQR() {
var ventanaImpresion = window.open("", "_blank");
var contenidoHTML = '<html><head><title>Códigos QR - Vista previa de impresión</title>';
contenidoHTML += '<style>';
contenidoHTML += 'body { font-family: Arial, sans-serif; margin: 0; padding: 20px; display: flex; flex-wrap: wrap; justify-content: center; align-items: center; }';
contenidoHTML += '.carne { width: 200px; height: auto; border: 1px solid #ccc; padding: 20px; margin: 10px; text-align: center; box-sizing: border-box; }';
contenidoHTML += '.nombre { font-weight: bold; }';
contenidoHTML += '.codigo-qr-container { display: flex; flex-direction: column; align-items: center; justify-content: center; margin-top: 10px; }';
contenidoHTML += '.codigo-qr { max-width: 100%; }';
contenidoHTML += '</style>';
contenidoHTML += '</head><body>';

var codigosQR = document.getElementsByClassName("carne");

for (var i = 0; i < codigosQR.length; i++) {
  contenidoHTML += '<div class="carne">';
  contenidoHTML += '<div class="codigo-qr-container">';
  contenidoHTML += codigosQR[i].innerHTML;
  contenidoHTML += '</div>';
  contenidoHTML += '</div>';
}

contenidoHTML += '</body></html>';

ventanaImpresion.document.open();
ventanaImpresion.document.write(contenidoHTML);
ventanaImpresion.document.close();

ventanaImpresion.print();
}