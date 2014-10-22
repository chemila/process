<?php
$res = pack('N', time());
var_dump(unpack('N', $res));

$res = pack('n', 10);
var_dump(unpack('n', $res));

$res = pack('c', 12);
var_dump(unpack('ctest', $res));

$res = pack('Nn', 1234567890, 10);
var_dump(unpack('Nstatus/nname', $res));
