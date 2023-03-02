<?php
$db = mysqli_connect('localhost', 'root', '', 'test');
if (!$db) {
    die('Error connect to DataBase');
    }
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);    
?>