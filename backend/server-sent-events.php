<?php

require __DIR__ . '/vendor/autoload.php';

header('Content-Type: text/event-stream');
echo "\n\n";

$previousData = null;
while (true) {
    $data = readData();
    if ($data !== $previousData) {
        echo "event: data-changed\n";
        echo 'data: ', json_encode($data), "\n";
        echo "\n\n";
        $previousData = $data;
    }
    usleep(500000);

    if (connection_aborted()) {
        break;
    }
}

