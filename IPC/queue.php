<?php
$msg_key = ftok(posix_getcwd(), 'Q');
$worker_num = 2;  //启动的Worker进程数量
$worker_pid = array();
$queue = msg_get_queue($msg_key, 0666);

if ($queue === false) {
    die("create queue fail\n");
}
for ($i = 0; $i < $worker_num; $i++) {
    $pid = pcntl_fork();
    //主进程
    if ($pid > 0) {
        $worker_pid[] = $pid;
        echo "create worker $i.pid = $pid\n";
        continue;
    }
    //子进程
    elseif ($pid == 0) {
        proc_worker($i);
        exit;
    }
    else {
        echo "fork fail\n";
    }
}

proc_main();

function proc_main() {
    global $queue;
    $bind = "udp://0.0.0.0:1234";
    //建立一个UDP服务器接收请求
    $socket = stream_socket_server($bind, $errno, $errstr, STREAM_SERVER_BIND);
    if (!$socket) {
        die("$errstr ($errno)");
    }
    stream_set_blocking($socket, 1); //NOTE: 阻塞模式
    echo "stream_socket_server bind=$bind\n";
    while (1) {
        $errCode = 0;
        $peer = '';
        $pkt = stream_socket_recvfrom($socket, 8192, 0, $peer); //NOTE: receive package from client
        fwrite(STDOUT, sprintf("get message from:%s\n", $peer));

        if ($pkt == false) {
            echo "udp error\n";
        }

        /**
         * @param resource $queue     句柄
         * @param int      $msgtype   msg type(just a flag)
         * @param string   $message   数据包
         * @param bool     $serialize = true 是否序列化，进行serialize($content)
         * @param bool     $serialize = true 阻塞模式，队列满了会阻塞, 非阻塞模式立即返回false
         */
        $ret = msg_send($queue, 1, $pkt, false, true, $errCode);
        if ($ret) {
            stream_socket_sendto($socket, "OK\n", 0, $peer);
        }
        else {
            stream_socket_sendto($socket, "ER\n", 0, $peer);
        }
    }
}

function proc_worker($id) {
    global $queue;
    $msg_type = 0;
    $msg_pkt = '';
    $errCode = 0;
    while (1) {
        /**
         * @param resource $queue msg对象
         * @param int $desiredmsgtype 0:  the message from the front of the queue is returned
         * @param int $msgtype
         * @param int $size
         * @param int $message 数据包
         * @param int $unserialize 是否反序列化
         */
        $ret = msg_receive($queue, 0, $msg_type, 8192, $msg_pkt, false, $errCode);
        if ($ret) {
            echo "[Worker $id] " . $msg_pkt;
        }
        else {
            echo "ERROR: queue errno={$errCode}\n";
        }
    }
}