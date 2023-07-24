navigator.mediaDevices.getUserMedia({ video: true })
  .then((stream) => {
    const video = document.getElementById('video');
    
    video.srcObject = stream;
    video.play();

    video.onloadedmetadata = () => {
      const canvas = document.createElement('canvas');
      const context = canvas.getContext('2d');
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;

      setInterval(() => {
        const estado = document.getElementById('estado').value;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        const qrCode = jsQR(imageData.data, imageData.width, imageData.height);
        if (qrCode) {
          const numeroDocumento = qrCode.data;
          console.log(numeroDocumento);
          // Definir la URL de tu script PHP. Asegúrate de reemplazarla con la tuya.
          const phpURL = './ingreso/ingresoQR.php';

          // Hacer una solicitud HTTP POST a tu script PHP.
          fetch(phpURL, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `indentificacion=${numeroDocumento}&ingresar=1&estado=${estado}`,
          })
          .then(response => response.text())
          .then(data => {
            data = JSON.parse(data);
            console.log('Respuesta del PHP:', data);

            let {state  } = data;

            switch (state) {
              case 'exito':
                Swal.fire({
                  icon: 'success',
                  title: 'Bienvenido',
                  text: 'Al campus Universitario Uniclaretiana ' 
                  });
                break;
              case 'salida':
                
                Swal.fire({
                  icon: 'success',
                  title: '¡Oh ya te vas!',
                  text: 'Hasta la proxima' 
                  });
                break;
              case 'registroDoble':
                Swal.fire({
                  icon: 'error',
                  title: '¡Ups!',
                  text: 'Ya has ingresado al campus, presiona en la opcion de salida'
                  });
                break;
              case 'salidaDoble':
                Swal.fire({
                  icon: 'error',
                  title: '¡Ups!',
                  text: 'Ya has ingresado al campus, presiona en la opcion de salida'
                  });
                break;
              case 'prohibido':
                Swal.fire({
                  icon: 'error',
                  title: '¡Ups!',
                  text: 'Ya has ingresado al campus, presiona en la opcion de salida'
                  });
                break;
            
              default:
                Swal.fire({
                  icon: 'error',
                  title: '¡Ups!',
                  text: 'Algo salio mal, intenta más tarde'
                  });
                break;
            }
          })
          .catch((error) => {
            console.log(error);
            //console.error('Error:', error);
          });
        }
      }, 2500); // Verifica cada 500ms
    }
  })
  .catch((err) => console.error(err));
