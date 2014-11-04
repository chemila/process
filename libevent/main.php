<?php
/**
 * callback
 *
 * @param resource $fd     自动传递的参数，文件句柄
 * @param int $events 自动传递的参数，event类型？
 * @param array    $arg    手动传递的参数
 */
function print_line($fd, $events, $arg) {
    static $max_requests = 0;
    $max_requests++;

    // print the line
    echo "your input is:" . fgets($fd);

    if ($max_requests >= 3) {
        // exit loop after 3 writes
        printf("tried %d times, then exit\n", $max_requests);
        event_base_loopexit($arg[1]);
    }
}

// create base and event
$base = event_base_new();
$event = event_new();

printf("please input a world:\n");
$fd = STDIN; // read from terminal

// set event flags, EV_PERSIST是否持久
event_set($event, $fd, EV_READ | EV_PERSIST , "print_line", array($event, $base));
// set event base
event_base_set($event, $base);

// enable event
event_add($event);
// start event loop
event_base_loop($base);
