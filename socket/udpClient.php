<?php
$fp = stream_socket_client("udp://127.0.0.1:1234", $errno, $errstr, 1);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
}
while (1) {
    fwrite($fp, 'test');
    while (!feof($fp)) {
        printf("%s\n", fgets($fp, 1024));
    }
}