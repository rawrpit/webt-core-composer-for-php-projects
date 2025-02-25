<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            width: 200px;
            margin-right: 10px;
        }
        button {
            padding: 10px 15px;
        }
        img {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>QR Code für die Telefonnummer</h1>
    <form method="POST" id="phoneForm">
        <label for="phone">Telefonnummer:</label>
        <input type="text" id="phone" name="phone" required>
        <button type="submit">QR Code generieren</button>
    </form>
    
    <h2>QR Code:</h2>
    <img id="qrCodeImage" src="" alt="QR Code" style="display:none;">
    
    <script>
        const form = document.getElementById('phoneForm');
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Verhindert das Standard-Formular-Verhalten
            const phoneNumber = document.getElementById('phone').value;
            const qrCodeImage = document.getElementById('qrCodeImage');
            
            const formData = new FormData();
            formData.append('phone', phoneNumber);
            
            fetch('genQR.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.blob())
            .then(imageBlob => {
                qrCodeImage.src = URL.createObjectURL(imageBlob);
                qrCodeImage.style.display = 'block';
                console.log(qrCodeImage.src);
            })
            .catch(error => {
                console.error('Fehler:', error);
            });
        });
    </script>
</body>
</html>