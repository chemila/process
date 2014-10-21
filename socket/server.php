<?php
date_default_timezone_set('Asia/shanghai');
$socket = stream_socket_server("tcp://0.0.0.0:1234", $errno, $errstr);
if (!$socket) {
    echo "$errstr ($errno)<br />\n";
}
else {
    while ($conn = stream_socket_accept($socket)) {
        printf("read:%s\n", fread($conn, 1024));
        fwrite($conn, 'The local time is ' . date('n/j/Y g:i a') . "\n");
        fclose($conn);
    }
    fclose($socket);
}