<?php
if (function_exists('cli_set_process_title')) {
    printf("function exist\n");
    @cli_set_process_title('test');
}
else {
    printf("function dont exist\n");
}