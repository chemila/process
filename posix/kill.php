<?php
$res = posix_kill(posix_getpid(), 0); // checkout process running
var_dump($res);

while(1) {
    printf("%d\n", time());
    sleep(1);
}