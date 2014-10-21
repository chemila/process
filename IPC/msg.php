<?php
date_default_timezone_set('Asia/shanghai');
$ipcKey = ftok(posix_getcwd(), 'm');

$msgId = msg_get_queue($ipcKey);
printf("get msg queue resource: %s\n", $msgId);

printf("queue status:");
$stat = msg_stat_queue($msgId);
print_r($stat);

if ($stat['msg_qnum'] <= 1) {
    $res = msg_send($msgId, 1, sprintf("test from queue @%s \n", date('Y-m-d H:i:s')));
    printf("send result:%d\n", $res);
}

printf("receive from queue:%s\n", msg_receive($msgId, 1, $type, 1024, $msg));
printf("the message is:%s", $msg);
