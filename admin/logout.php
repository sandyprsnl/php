<?php
ob_start();
session_start();
header('location:loginpanel.php');
session_destroy();
?>