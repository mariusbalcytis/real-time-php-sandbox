<?php

require __DIR__ . '/vendor/autoload.php';

$originalData = $data = readData();

for ($i = 0; $i < 30; $i++) {
    $data = readData();
    if ($data !== $originalData) {
        break;
    }
    usleep(500000);
}

header('Content-Type: application/json');
echo json_encode($data);
