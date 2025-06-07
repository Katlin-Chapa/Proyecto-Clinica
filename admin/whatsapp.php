<?php

include("../connection.php");

// Configuración de API de WhatsApp
$instanceId = '67343'; 
$apiToken = 'nCY4j7dmX0Q4fWaYYf2DzHIHafrV6AkAkDyslbKCe47d7164';

if(isset($_POST['send_whatsapp'])) {
    $numeroDestino = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];

    // Agregar el código de país si no está incluido
    if (strpos($numeroDestino, '502') !== 0) {
        $numeroDestino = '502' . $numeroDestino;
    }

    $chatId = $numeroDestino . '@c.us';

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://waapi.app/api/v1/instances/{$instanceId}/client/action/send-message",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'chatId' => $chatId,
            'message' => $mensaje
        ]),
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer {$apiToken}",
            "Content-Type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "Error: " . $err;
    } else {
        echo "Mensaje enviado correctamente.";
    }
}

?>
