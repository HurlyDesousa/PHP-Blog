<?php
//Prologue of logout.inc.php:
//This page is in an includes folder an runs only php code. It closes the session and sets the user as logged out.
session_start();
session_unset();
session_destroy();

header("Location: ../index.php");
