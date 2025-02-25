<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Emergency Coil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        form {
            margin: 20px 0;
        }
        input[type="text"] {
            padding: 8px;
            width: 200px;
            margin-right: 10px;
        }
        button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .qr-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        img {
            max-width: 300px;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <h1>Pet Emergency Coil</h1>
    <p>Generiere deine Nummer als QR Code</p>
    
    <form method="POST" id="phoneForm">
        <label for="phone">Phone number:</label>
        <input type="text" id="phone" name="phone" placeholder="+43 1 22 33 444" required>
        <button type="submit">Generate QR Code</button>
    </form>
    
    <div class="qr-container">
        <h2>Dein QR Code:</h2>
        <img id="qrCodeImage" src="" alt="QR Code" style="display:none;">
    </div>
    
    <script>
        document.getElementById('phoneForm').addEventListener('submit', function(event) {
            event.preventDefault();
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
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>