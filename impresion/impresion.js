 // Función para imprimir los códigos QR
 function imprimirCodigosQR() {
    if (!qrGenerados) {
      alert("Primero debes generar los códigos QR.");
      return;
    }

    var ventanaImpresion = window.open("", "_blank");
    var contenidoHTML =
      '<html><head><title>Códigos QR - Vista previa de impresión</title>';
    contenidoHTML += '<style>';
    contenidoHTML +=
      'body { font-family: Arial, sans-serif; margin: 0; padding: 20px; display: flex; flex-wrap: wrap; justify-content: center; align-items: center; }';
    contenidoHTML +=
      '.carne { width: 200px; height: auto; border: 1px solid #ccc; padding: 20px; margin: 10px; text-align: center; box-sizing: border-box; }';
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