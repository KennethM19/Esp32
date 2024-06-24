<?php
session_start();
session_destroy();
$redirectUrl = 'pageIndex.php';
header("location:" . $redirectUrl);
