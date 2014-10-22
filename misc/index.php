<?php
error_reporting(E_ERROR);
ini_set('display_errors', 'off');

$test = new test();
$test->b();

var_dump(error_get_last());

class test {
    function a() {

    }
}