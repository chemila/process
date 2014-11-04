<?php
printf("get ipc key:%s\n", ftok(posix_getcwd(), 'x'));