<?php
session_start();
session_destroy();
$redirectUrl = 'Index.php';
header("location:".$redirectUrl);
