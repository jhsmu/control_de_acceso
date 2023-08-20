function generarCodigoQR() {
    var nombre = document.getElementsByName("nombre")[0].value;
    var cargoSelect = document.getElementById("cargo");
    var cargo = cargoSelect.options[cargoSelect.selectedIndex].text;
    var identificacion = document.getElementsByName("documento")[0].value;
  
    if (nombre === "" || cargo === "" || identificacion === "") {
      alert("Por favor, completa todos los campos antes de generar el código QR.");
      return;
    }
  
    var modalBody = document.getElementById("modalBody");
    modalBody.innerHTML = ""; // Limpiar el contenido del modal antes de generar los nuevos
  
    var carne = document.createElement("div");
    carne.className = "carne";
  
    var nombreElement = document.createElement("p");
    nombreElement.className = "nombre";
    nombreElement.textContent = "Nombre:" + nombre;
    carne.appendChild(nombreElement);
  
    var identificacionElement = document.createElement("p");
    identificacionElement.className = "identificacion";
    identificacionElement.textContent = "Identificación: " + identificacion;
    carne.appendChild(identificacionElement);
  
    var cargoElement = document.createElement("p");
    cargoElement.className = "cargo";
    cargoElement.textContent = "Cargo: " + cargo;
    carne.appendChild(cargoElement);
  
    var qrElement = document.createElement("div");
    qrElement.className = "codigo-qr";
    carne.appendChild(qrElement);
  
    var qrCode = new QRCode(qrElement, {
      text: identificacion,
      width: 128,
      height: 128
    });
  
    modalBody.appendChild(carne);
  
    // Mostrar el modal
    $('#modalCodigosQR').modal('show');
  }
  function imprimirCodigosQR() {
    var modalBody = document.getElementById("modalBody");
    var codigosQR = modalBody.getElementsByClassName("carne");
  
    var contenidoHTML = '<html><head><title>Códigos QR - Vista previa de impresión</title>';
    contenidoHTML += '<style>';
    contenidoHTML += 'body { font-family: Arial, sans-serif; margin: 0; padding: 20px; display: flex; flex-wrap: wrap; justify-content: center; align-items: center; }';
    contenidoHTML += '.carne { width: 200px; height: auto; border: 1px solid #ccc; padding: 20px; margin: 10px; text-align: center; box-sizing: border-box; }';
    contenidoHTML += '.nombre { font-weight: bold; }';
    contenidoHTML += '.codigo-qr-container { display: flex; flex-direction: column; align-items: center; justify-content: center; margin-top: 10px; }';
    contenidoHTML += '.codigo-qr { max-width: 100%; }';
    contenidoHTML += '</style>';
    contenidoHTML += '</head><body>';
  
    for (var i = 0; i < codigosQR.length; i++) {
      contenidoHTML += '<div class="carne">';
      contenidoHTML += '<div class="codigo-qr-container">';
      contenidoHTML += codigosQR[i].innerHTML;
      contenidoHTML += '</div>';
      contenidoHTML += '</div>';
    }
  
    contenidoHTML += '</body></html>';
  
    var ventanaImpresion = window.open("", "_blank");
    ventanaImpresion.document.open();
    ventanaImpresion.document.write(contenidoHTML);
    ventanaImpresion.document.close();
  
    ventanaImpresion.print();
  }