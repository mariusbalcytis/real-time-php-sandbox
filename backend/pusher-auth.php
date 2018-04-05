<?php

require __DIR__ . '/vendor/autoload.php';

$currentUser = @$_SERVER['HTTP_X_CURRENT_USER'];
if ($_POST['channel_name'] === 'private-data-for-' . $currentUser) {
    header('Content-Type: application/json');
    if ($_GET['poxa']) {
        $service = getPoxaService();
    } else {
        $service = getPusherService();
    }
    echo $service->socket_auth($_POST['channel_name'], $_POST['socket_id']);
} else {
    header('HTTP/1.1 403 Forbidden');
}
