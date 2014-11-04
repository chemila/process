<?php
$fp = stream_socket_client("tcp://127.0.0.1:1234", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
}
else {
    fwrite($fp, "test");
    while (!feof($fp)) {
        echo fgets($fp, 1024);
    }
    fclose($fp);
}