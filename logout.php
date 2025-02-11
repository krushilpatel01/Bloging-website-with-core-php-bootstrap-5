<?php
session_start(); // Start the session to manage sessions

session_destroy();
header("location :login.php");


?>