<?php

require __DIR__ . '/vendor/autoload.php';

echo '<html><body>';
$previousData = null;
while (true) {
    $data = readData();
    if ($data !== $previousData) {
        echo '<script>parent.handleData(', json_encode($data), ');</script>';

        $previousData = $data;
    }
    usleep(500000);

    if (connection_aborted()) {
        break;
    }
}

echo '</body></html>';

