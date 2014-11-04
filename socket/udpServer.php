<?php
$socket = stream_socket_server("udp://127.0.0.1:1234", $errno, $errstr, STREAM_SERVER_BIND);
stream_set_blocking($socket, 0);
if (!$socket) {
    printf("create udp socket error:%s\n", $errstr);
}

while(1) {
    printf("read:%s\n", stream_socket_recvfrom($socket, 1024, 0, $address));
    if ($address) {
        stream_socket_sendto($socket, 'got it at'.time(), 0, $address);
    }
    sleep(2);
}
