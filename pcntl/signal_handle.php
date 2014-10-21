<?php
echo "Installing signal handler...\n";
pcntl_signal(
    SIGHUP, function ($signo) {
        echo "signal handler called\n";
    }
);

$pid = posix_getpid();
echo "Generating signal SIGHUP to self...\n";
printf("current pid:%d\n", $pid);
posix_kill($pid, SIGHUP);

echo "Dispatching...\n";
pcntl_signal_dispatch();

echo "Done\n";
