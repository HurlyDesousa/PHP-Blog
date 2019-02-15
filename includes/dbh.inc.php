<?php
//Prologue of dbh.inc.php:
//This page is in an includes folder an runs only php code. It establishes the database conection.

$host_name = 'db765643649.hosting-data.io';
$database = 'db765643649';
$user_name = 'dbo765643649';
$password = 'N4Mr%vaGhRdw84Y';
$conn = mysqli_connect($host_name, $user_name, $password, $database);

if (mysqli_connect_errno()) {
    die('<p>Failed to connect to MySQL: '.mysqli_connect_error().'</p>');
}
