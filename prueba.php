<!DOCTYPE html>
<html>
<head>
    <title>Carné con código QR</title>
    <style>
        .carne {
            width: 300px;
            height: 200px;
            border: 1px solid #000;
            padding: 20px;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .qr-code {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="carne">
        <h2>Nombre: Juan Pérez</h2>
        <p>Cargo: Estudiante</p>
        <div id="qr-code" class="qr-code"></div>
        <button onclick="generarQR()">Generar código QR</button>
    </div>

    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script>
        function generarQR() {
            var qrCodeDiv = document.getElementById("qr-code");
            var qrCode = new QRCode(qrCodeDiv, {
                width: 128,
                height: 128
            });

            var url = "https://www.youtube.com"; // URL a codificar en el código QR
            qrCode.makeCode(url);
        }
    </script>
</body>
</html>
