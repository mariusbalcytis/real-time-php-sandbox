<?php

require __DIR__ . '/vendor/autoload.php';

$data = readData();
$data['text'] = @$_POST['text'];
writeData($data);

header('Content-Type: application/json');
echo json_encode($data);
