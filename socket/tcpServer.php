<?php
$socket = stream_socket_server("tcp://0.0.0.0:1234", $errno, $errstr);
if (!$socket) {
    echo "$errstr ($errno)<br />\n";
}
else {
    while ($conn = stream_socket_accept($socket)) { // UDP不需要connection过程
        printf("read:%s\n", fread($conn, 1024));
        fwrite($conn, 'The local time is ' . date('n/j/Y g:i a') . "\n");
        fclose($conn);
    }
    fclose($socket);
}