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
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        const qrCode = jsQR(imageData.data, imageData.width, imageData.height);
        if (qrCode) {
          const numeroDocumento = qrCode.data;

          // Definir la URL de tu script PHP. Asegúrate de reemplazarla con la tuya.
          const phpURL = './ingreso/ingresoQR.php';

          // Hacer una solicitud HTTP POST a tu script PHP.
          fetch(phpURL, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `indentificacion=${numeroDocumento}&ingresar=1&estado=1`,
          })
          .then(response => response.text())
          .then(data => {
            console.log('Respuesta del PHP:', data);
          })
          .catch((error) => {
            console.error('Error:', error);
          });
        }
      }, 500); // Verifica cada 500ms
    }
  })
  .catch((err) => console.error(err));
