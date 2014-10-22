<?php
pcntl_signal(SIGALRM, 'test');
pcntl_alarm(1);
function test() {
    static $count = 1;
    printf("count: %d\n", $count ++);
    pcntl_alarm(1); // 循环计时器
}
while(1) {
    pcntl_signal_dispatch();
}

