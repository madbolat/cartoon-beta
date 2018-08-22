<?php

define('MAD', 1);

session_start();
require_once($_SERVER['DOCUMENT_ROOR'].'/sys/load.php');

$run = new Load();
$run->run();

?>