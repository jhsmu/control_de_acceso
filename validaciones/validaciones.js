//Nombres y apellidos : nombre , apellido
function nombre1() { 
  let nombre = document.getElementById("nombre").value;
  let RegEx = /^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$/g;

  if(nombre.length < 50)
    if (RegEx.test(nombre) == true) {
      document.getElementById("nombre").style.borderColor = "#008000";
    } else {
      document.getElementById("nombre").style.borderColor = "#FF0000";
      Swal.fire({
        icon: 'error',
        title: 'Por Favor',
        text: 'Evite el uso de números y caracteres especiales(" , . ; { } [ ] ")',
        });
        document.getElementById("nombre").value = "";
      return false;
} else {
    document.getElementById("nombre").style.borderColor = "#FF0000";
    Swal.fire({
      icon: "error",
      title: "Por Favor",
      text: "El nombre es muy largo",
    });
    document.getElementById("nombre").value = "";
  }
}
function apellido1() {
  let apellido = document.getElementById("apellido").value;
  let RegEx = /^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$/g;

  if (apellido.length < 50)
    if (RegEx.test(apellido) == true) {
      document.getElementById("apellido").style.borderColor = "#008000";
    } else {
      document.getElementById("apellido").style.borderColor = "#FF0000";
      Swal.fire({
        icon: "error",
        title: "Por Favor",
        text: 'Evite el uso de números y caracteres especiales(" , . ; { } [ ] ")',
      });
      document.getElementById("apellido").value= "";
      return false;
    }
  else {
    document.getElementById("apellido").style.borderColor = "#FF0000";
    Swal.fire({
      icon: "error",
      title: "Por Favor",
      text: "El apellido es muy largo",
    });
    document.getElementById("apellido").value= "";
  }
}
function cedula1(){
  let cedula = document.getElementById("documento").value;
  let regex = /^[0-9]+$/g;
  let tamaño = cedula.length;

  if(regex.test(cedula)){
    if (7 <= tamaño &&  tamaño <= 11){
      document.getElementById("documento").style.borderColor = "#008000";
    }else{
      document.getElementById("documento").style.borderColor = "#FF0000";
        Swal.fire({
          icon: "error",
          title: "Por Favor",
          text: "La cedula acepta solo numeros entre 7 y 11 digitos",});
          document.getElementById("documento").value = "";
    }
  }else{
    document.getElementById("documento").style.borderColor = "#FF0000";
      Swal.fire({
        icon: "error",
        title: "Por Favor",
        text: "La cedula acepta solo numeros",});
        document.getElementById("documento").value = "";
  }
}

function cedula2(){
  let cedula = document.getElementById("identificacion").value;
  let regex = /^[0-9]+$/g;
  let tamaño = cedula.length;

  if(regex.test(cedula)){
    if (7 <= tamaño &&  tamaño <= 11){
      document.getElementById("identificacion").style.borderColor = "#008000";
    }else{
      document.getElementById("identificacion").style.borderColor = "#FF0000";
        Swal.fire({
          icon: "error",
          title: "Por Favor",
          text: "La cedula acepta solo numeros entre 7 y 11 digitos",});
          document.getElementById("identificacion").value = "";
    }
  }else{
    document.getElementById("identificacion").style.borderColor = "#FF0000";
      Swal.fire({
        icon: "error",
        title: "Por Favor",
        text: "La cedula acepta solo numeros",});
        document.getElementById("identificacion").value = "";
  }
}

//correos en general : correo
function correo1() {
  let correo = document.getElementById("correo").value;
/*   let regex =/^[a-zA-Z0-9.!#$%&'+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(.[a-zA-Z0-9-]+)$/;
 */  let regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/;
  
  if (regex.test(correo)) {
    if(correo.length <60 ){
      document.getElementById("correo").style.borderColor = "#008000";
      } else {
      document.getElementById("correo").style.borderColor = "#FF0000";
      Swal.fire({
        icon: "error",
        title: "Por Favor",
        text: 'Ingrese un correo con menos de 60 dígitos',
      });
      document.getElementById("correo").value = ""
    }
  }else {
    document.getElementById("correo").style.borderColor = "#FF0000";
    Swal.fire({
      icon: "error",
      title: "Por Favor",
      text: 'Ingrese un correo valido añadiendo "@"',
    });
    document.getElementById("correo").value = ""
  }
}


//teléfonos de 7 o 10 dígitos : teléfono
function telefono1() {
  let telefono = document.getElementById("telefono").value;
  let TelLen = telefono.length;
  let RegEx = /^[+<0-9]+$/g; 

  if (RegEx.test(telefono)){
    if ((TelLen == 10) || (TelLen == 13)) {
      document.getElementById("telefono").style.borderColor = "#008000";
    } else {
      document.getElementById("telefono").style.borderColor = "#FF0000";
      Swal.fire({
        icon: "error",
        title: "Por Favor",
        text: "Su numero es invalido",
      });
      document.getElementById("telefono").value = "";
    }
  }else {
    document.getElementById("telefono").style.borderColor = "#FF0000";
    Swal.fire({
      icon: "error",
      title: "Por Favor",
      text: "Su numero es invalido",
    });
    document.getElementById("telefono").value = "";
  }
}