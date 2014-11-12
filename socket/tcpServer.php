<?php
$socket = stream_socket_server("tcp://0.0.0.0:1234", $errno, $errstr);
if (!$socket) {
    echo "$errstr ($errno)<br />\n";
}
else {
    while ($conn = stream_socket_accept($socket)) { // UDP不需要connection过程
//        printf("read:%s\n", fread($conn, 1024));
//        fwrite($conn, 'The local time is ' . date('n/j/Y g:i a') . "\n");
        $address = null;
        $buff = stream_socket_recvfrom($conn, 1024, null, $address);
        if (!$buff) continue;
        printf("read from buff: %s\n", $buff);
//        stream_socket_sendto($conn, 'i got it', null, $address);
        fwrite($conn, 'i got it');
//        fclose($conn);
    }
    fclose($socket);
}