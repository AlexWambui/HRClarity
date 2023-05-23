<?php 

session_start();
session_destroy();
//to destroy only one session
//unset($_SESSION["id"]);
header('location: ../views/login.php');