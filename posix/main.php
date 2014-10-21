<?php
printf("current process pid:%d\n", posix_getpid());
printf("current process ppid:%d\n", posix_getppid());
printf("current process pgid:%d\n", posix_getpgid(posix_getpid()));

printf("user info :");
print_r(posix_getpwnam('jo'));

printf("current resource limit is:");
print_r(posix_getrlimit());
