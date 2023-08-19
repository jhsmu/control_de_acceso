// Variables globales para almacenar los datos del tutor y los estudiantes
var tutorData = {};
var studentsData = [];
var qrGenerados = false; // Variable para indicar si los códigos QR ya se generaron

// Función para generar el código QR en el formulario del tutor
function generarCodigoQRTutor() {
  var nombreTutor = document.getElementById("nombre").value;
  var institucionTutor = document.getElementById("institucion").value;
  var identificacion = document.getElementById("identificacion").value;

  tutorData = {
    nombre: nombreTutor,
    institucion: institucionTutor,
    documento: identificacion,
  };

  var qrElementTutor = document.createElement("div");
  qrElementTutor.className = "carne";

  var nombreElementTutor = document.createElement("p");
  nombreElementTutor.className = "nombre";
  nombreElementTutor.textContent = "Tutor: " + nombreTutor;
  qrElementTutor.appendChild(nombreElementTutor);

  var institucionElementTutor = document.createElement("p");
  institucionElementTutor.className = "institucion";
  institucionElementTutor.textContent = "Institución: " + institucionTutor;
  qrElementTutor.appendChild(institucionElementTutor);

  var documentoElementTutor = document.createElement("p");
  documentoElementTutor.className = "documento";
  documentoElementTutor.textContent = "Documento: " + identificacion;
  qrElementTutor.appendChild(documentoElementTutor);

  var qrCodeTutor = new QRCode(qrElementTutor, {
    text: identificacion,
    width: 128,
    height: 128,
  });

  qrElementTutor.setAttribute("data-tipo", "tutor");

  document.getElementById("modalBody").appendChild(qrElementTutor);
  // Agregar la raya para separar al tutor de los estudiantes
  var raya = document.createElement("hr");
  document.getElementById("modalBody").appendChild(raya);


    // Deshabilitar el botón una vez generado el código QR del tutor
    document.getElementById('btnGenerarQR').disabled = true;
    qrGenerados = true; // Marcar los códigos QR como generados
}

// Función para procesar el archivo Excel y generar códigos QR para estudiantes y el tutor
function procesarArchivoExcel() {
  var archivo = document.getElementById("archivo").files[0];
  var reader = new FileReader();

  reader.onload = function (e) {
    var data = new Uint8Array(e.target.result);
    var workbook = XLSX.read(data, { type: "array" });

    // Obtener la primera hoja del archivo Excel
    var sheetName = workbook.SheetNames[0];
    var worksheet = workbook.Sheets[sheetName];

    // Obtener la institución del tutor del formulario
    var institucionTutor = document.getElementById("institucion").value;

    // Aquí debes definir el código para procesar el archivo Excel y obtener los datos de los estudiantes
    studentsData = [];
    var range = XLSX.utils.decode_range(worksheet["!ref"]);
    for (var rowNum = 1; rowNum <= range.e.r; rowNum++) {
      var cellNombre = worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 0 })];
      var cellApellido = worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 1 })];
      var cellDocumento = worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 2 })];
      var cellGrado = worksheet[XLSX.utils.encode_cell({ r: rowNum, c: 3 })];

      var nombre = cellNombre ? cellNombre.v : "";
      var apellido = cellApellido ? cellApellido.v : "";
      var documento = cellDocumento ? cellDocumento.v : "";
      var grado = cellGrado ? cellGrado.v : "";

      studentsData.push({
        nombre: nombre,
        apellido: apellido,
        documento: documento,
        institucion: institucionTutor,
        grado: grado,
      });
    }

    // Generar el código QR para el tutor
    generarCodigoQRTutor();

    // Generar los códigos QR basados en el número de documento para estudiantes
    generarCodigosQR(studentsData, "estudiante");
  };

  reader.readAsArrayBuffer(archivo);
}

// Función para mostrar los códigos QR generados
function generarCodigosQR(datos, tipo) {
  for (var i = 0; i < datos.length; i++) {
    var estudiante = datos[i];
    var nombre = estudiante.nombre;
    var apellido = estudiante.apellido;
    var documento = estudiante.documento;
    var institucion = estudiante.institucion;
    var grado = estudiante.grado;

    // Crear la card con la información del estudiante y su código QR
    var card = document.createElement("div");
    card.className = "carne";

    var nombreElement = document.createElement("p");
    nombreElement.className = "nombre";
    nombreElement.textContent = "Nombre: " + nombre + " " + apellido;
    card.appendChild(nombreElement);

    var institucionElement = document.createElement("p");
    institucionElement.className = "institucion";
    institucionElement.textContent = "Institución: " + institucion;
    card.appendChild(institucionElement);

    var documentoElement = document.createElement("p");
    documentoElement.className = "documento";
    documentoElement.textContent = "Documento: " + documento;
    card.appendChild(documentoElement);

    var gradoElement = document.createElement("p");
    gradoElement.className = "grado";
    gradoElement.textContent = "Grado: " + grado;
    card.appendChild(gradoElement);

    var qrElement = document.createElement("div");
    qrElement.className = "codigo-qr";
    card.appendChild(qrElement);

    // Generar el código QR para el estudiante
    var qrCode = new QRCode(qrElement, {
      text: documento,
      width: 128,
      height: 128,
    });

    qrElement.setAttribute("data-tipo", tipo);

    document.getElementById("modalBody").appendChild(card);
  }

  // Mostrar el modal con los códigos QR
  mostrarModalQR();
}

// Función para mostrar el modal con los códigos QR
function mostrarModalQR() {
  var modal = new bootstrap.Modal(document.getElementById('modalMostrarQR'), {});
  modal.show();
}

// Evento para generar los códigos QR al hacer clic en el botón
document.getElementById('btnGenerarQR').addEventListener('click', function () {
  var archivo = document.getElementById("archivo").files[0];
  if (archivo) {
    // Si se seleccionó un archivo, procesar el archivo Excel
    procesarArchivoExcel();
  } else {
    // Si no se seleccionó un archivo, generar el código QR del tutor
    generarCodigoQRTutor();
    // Mostrar el modal con el código QR
    mostrarModalQR();
  }
});