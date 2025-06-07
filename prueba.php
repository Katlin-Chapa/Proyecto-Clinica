<?php

// Configuración
$instanceId = '67343'; // Reemplaza con tu ID de instancia
$apiToken = 'nCY4j7dmX0Q4fWaYYf2DzHIHafrV6AkAkDyslbKCe47d7164'; // Reemplaza con tu token de API
$numeroDestino = '50250416572'; // Reemplaza con el número de teléfono del destinatario en formato internacional sin el signo '+'
$mensaje = '¡Hola desde WaAPI con PHP!';

// Formatear el chatId
$chatId = $numeroDestino . '@c.us';

// Configurar la solicitud cURL
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://waapi.app/api/v1/instances/{$instanceId}/client/action/send-message",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode([
        'chatId' => $chatId,
        'message' => $mensaje
    ]),
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer {$apiToken}",
        "Accept: application/json",
        "Content-Type: application/json"
    ],
]);

// Ejecutar la solicitud y manejar la respuesta
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "Error en cURL: " . $err;
} else {
    echo "Respuesta de la API: " . $response;
}
?>
