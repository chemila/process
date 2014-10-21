<?php
$ipcKey = ftok(posix_getcwd(), 's');
$semId = sem_get($ipcKey, 1);

printf("acquire sem:%d\n", sem_acquire($semId));

sleep(10);
sem_release($semId);