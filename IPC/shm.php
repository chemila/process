<?php
$ipcKey = ftok(posix_getcwd(), 'x');
$shmId = shm_attach($ipcKey, 1024);

if (!$shmId) {
    printf("create shm failed\n");
}

$sKey = 111;
printf("has var or not:%d\n", shm_has_var($shmId, $sKey));

printf("put var now\n");
shm_put_var($shmId, $sKey, 'test');

printf("get var:%s\n", shm_get_var($shmId, $sKey));

printf("delete var\n", shm_remove_var($shmId, $sKey));

shm_remove($shmId);