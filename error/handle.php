<?php
ini_set('display_errors', 'on');
error_reporting(0);
register_shutdown_function("fatal_handler");

function fatal_handler() {
    $error = error_get_last();

    if ($error !== null) {
        $errno = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr = $error["message"];

        printf("line:%d, error:%s, type:%s\n", $errline, $errstr, $errno);
    }

}

class A {
    function m() {
    }
}

$a = new A();
$a->m();

//$a->methodNotExist();
var_dump(implode(',', 1));
//throw new Exception('test');
