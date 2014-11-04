<?php
$server = stream_socket_server('tcp://127.0.0.1:1234');
if (!$server) {
    printf("create socket failed\n");
}

$socket = stream_socket_accept($server); //NOTE: TCP accept is required
$pair = stream_socket_pair(STREAM_PF_UNIX, STREAM_SOCK_STREAM, STREAM_IPPROTO_IP);
stream_set_blocking($pair[0], 0);

while(1) {
    sleep(2);
    $reads = array($pair[0], $socket);
    $writes = null;
    $exceptions = null;
    $ret = stream_select($reads, $writes, $exceptions, 1);

    if ($ret === 0) {
        printf("no data\n");
        continue;
    }

    if (false === $ret) {
        printf("error\n");
        continue;
    }

    foreach ($reads as $changedFd) {
        $msg = stream_socket_recvfrom($changedFd, 1024);
        printf("receive message:%s\n", $msg);
    }
}
