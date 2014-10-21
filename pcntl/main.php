<?php
declare(ticks = 1);

$pid = pcntl_fork();
if ($pid == -1) {
    die("could not fork");
}
else if ($pid) {
    printf("we are the parent\n");
    exit(); // we are the parent
}
else {
    // we are the child
    printf("we are the child\n");
}

// detatch from the controlling terminal
if (posix_setsid() == -1) {
    die("could not detach from terminal");
}

//setproctitle('test');
// setup signal handlers
pcntl_signal(SIGTERM, "sig_handler");
pcntl_signal(SIGHUP, "sig_handler");
while(1) {

}

function sig_handler($sig) {

    switch ($sig) {
        case SIGTERM:
            // handle shutdown tasks
            printf("caught sig:%d\n", SIGTERM);
            exit;
            break;
        case SIGHUP:
            printf("caught sig:%d\n", SIGHUP);
            exit;
            // handle restart tasks
            break;
        default:
            // handle all other signals
    }

}