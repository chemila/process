<?php
$file = '/etc/networks';

if (posix_access($file, POSIX_F_OK | POSIX_W_OK )) {
    printf("ok\n");

}
else {
    $error = posix_get_last_error();
    printf("error:%d\n", $error);
    printf("msg:%s\n", posix_strerror($error));
}