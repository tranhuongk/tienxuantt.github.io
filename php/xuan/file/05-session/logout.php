<?php
session_start();
$_SESSION["trangthai"] = false;
header("location: login.php");