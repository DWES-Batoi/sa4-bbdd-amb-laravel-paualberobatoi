<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client(['base_uri' => 'http://localhost:8000/api/']);

// 1. Obtener token (usamos un usuario existente o creamos uno si falla)
$token = '';
echo "1. Intentando login admin...\n";
try {
    $response = $client->post('login', [
        'json' => [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]
    ]);
    $data = json_decode($response->getBody(), true);
    if (isset($data['data']['token'])) {
        $token = $data['data']['token'];
        echo "✅ Login correcto. Token: " . substr($token, 0, 10) . "...\n\n";
    }
} catch (RequestException $e) {
    echo "⚠️ Login falló, intentando registro nuevo...\n";
    try {
        $email = 'admin_partit_' . time() . '@example.com';
        $response = $client->post('register', [
            'json' => [
                'name' => 'Admin Partit',
                'email' => $email,
                'password' => 'password',
                'confirm_password' => 'password',
            ]
        ]);
        $data = json_decode($response->getBody(), true);
        $token = $data['data']['token'];
        echo "✅ Usuario registrado ($email). Token: " . substr($token, 0, 10) . "...\n\n";
    } catch (Exception $ex) {
        die("❌ Error fatal obteniendo token: " . $ex->getMessage() . "\n");
    }
}

echo "2. Creando un PARTIT (ruta protegida)...\n";

try {
    $response = $client->post('partits', [
        'headers' => [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ],
        'json' => [
            'equip_local_id' => 1,
            'equip_visitant_id' => 2,
            'estadi_id' => 1,
            'data_partit' => date('Y-m-d H:i:s'),
            'gols_local' => 2,
            'gols_visitant' => 1
        ]
    ]);
    
    $data = json_decode($response->getBody(), true);
    echo "✅ Partido creado: " . ($data['data']['equip_local_nom'] ?? 'Local') . " vs " . ($data['data']['equip_visitant_nom'] ?? 'Visitant') . " (ID: " . $data['data']['id'] . ")\n\n";

} catch (RequestException $e) {
    echo "❌ Error creando partido: " . $e->getMessage() . "\n";
    if ($e->hasResponse()) {
        echo $e->getResponse()->getBody() . "\n";
    }
}

echo "3. Listando PARTITS (ruta pública)...\n";

try {
    $response = $client->get('partits');
    $data = json_decode($response->getBody(), true);
    
    echo "✅ Listado obtenido. Total partidos: " . count($data['data']) . "\n";
    print_r($data['data'][0] ?? 'No hay datos');
    echo "\n";

} catch (RequestException $e) {
    echo "❌ Error listando: " . $e->getMessage() . "\n";
}
