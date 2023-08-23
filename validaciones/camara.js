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
          const phpURL = './ingreso/ingresoQR.php';

          fetch(phpURL, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `identificacion=${numeroDocumento}&ingresar=1&estado=${estado}`,
          })
          .then(response => response.text())
          .then(data => {
            console.log('Respuesta del servidor:', data); // Agrega este console.log
            data = JSON.parse(data);
            let {state  } = data;
            console.log('Estado recibido:', state); // Agrega este console.log
            switch (state) {
              case 'salida':
                Swal.fire({
                  icon: 'success',
                  title: '¡Oh ya te vas!',
                  text: 'Hasta la proxima' 
                  });
                break;
              case 'registroDoble':
                Swal.fire({
                  icon: 'info',
                  title: '¡Ups!',
                  text: 'Ya has ingresado al campus, presiona en la opcion de salida'
                  });
                break;
              case 'prohibido':
                Swal.fire({
                  icon: 'error',
                  title: '¡Ups!',
                  text: 'Lo sentimos pero tu no eres del campus'
                  });
                break;
                case 'verificar':
                  setTimeout(function() {
                    window.location.href = './index.php';
                }, 800); 
                  break;

              case 'inhabilitado':
                Swal.fire({
                  icon: 'warning',
                  title: '!Ohh lo sentimos¡',
                  text: 'Pero actualmente estas Inhabilitado comunicate con...'
                  });
                break;
                
              default:
                Swal.fire({
                  icon: 'error',
                  title: '¡Ups!',
                  text: 'Algo salio mal, intenta más tarde por favor'
                  });
                break;
            }
          })
          .catch((error) => {
            console.log(error);
          });
        }
      }, 2500); // Verifica cada 2500ms
    }
  })
  .catch((err) => console.error(err));