<?php

function readData() {
    $filename = __DIR__ . '/data.json';

    $data = json_decode(@file_get_contents($filename) ?: '{}', true);
    $data['text'] = $data['text'] ?? '';

    return $data;
}

function writeData($data) {
    $filename = __DIR__ . '/data.json';
    file_put_contents($filename, json_encode($data));

    notify($data);
}


function notify($data) {
    getPoxaService()->trigger('data-channel', 'data-changed', $data);
    getPusherService()->trigger('data-channel', 'data-changed', $data);

    $data['text'] = 'Secret: ' . $data['text'];
    getPoxaService()->trigger('private-data-for-marius', 'data-changed', $data);
    getPusherService()->trigger('private-data-for-marius', 'data-changed', $data);
}

function getPusherService() {
    return new Pusher\Pusher(
        '1e150f1ce6ee03af0d34',
        '77eb4871ddf660102990',
        '503086',
        [
            'cluster' => 'eu',
            'encrypted' => true
        ]
    );
}
function getPoxaService() {
    return new Pusher\Pusher(
        'application_key',
        'my_super_secret_key',
        'application_id',
        [
            'host' => 'poxa',
            'port' => '8080',
        ]
    );
}