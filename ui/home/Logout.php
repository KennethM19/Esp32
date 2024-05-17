<?php
session_start();
session_destroy();
$redirectUrl = 'Login.php';
header("location:".$redirectUrl);
