<?php
require __DIR__ . '/vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['phone'])) {
        $phoneNumber = $_POST['phone'];
    } else {
        $phoneNumber = '';
    }

    if (empty($phoneNumber)) {
        http_response_code(400);
        exit('Phone number is required');
    }

    $phoneNumber = preg_replace('/[^0-9+]/', '', $phoneNumber);
    if (!empty($phoneNumber)) {
        $phoneNumber = 'tel:' . $phoneNumber;
    }
} else {
    $phoneNumber = 'tel:+431223344';
}


try {
    $qrCode = new QrCode($phoneNumber);
    $qrCode->setSize(300);
    $qrCode->setMargin(10);
    $qrCode->setEncoding(new Encoding('UTF-8'));
    $qrCode->setForegroundColor(new Color(0, 0, 0));
    $qrCode->setBackgroundColor(new Color(255, 255, 255));

    $writer = new PngWriter();

    $pngData = $writer->write($qrCode)->getString();
    
    header('Content-Type: image/png');
    header('Content-Length: ' . strlen($pngData));
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    echo $pngData;
    exit;
} catch (Exception $e) {
    http_response_code(500);
    exit('Error generating QR code: ' . $e->getMessage());
}