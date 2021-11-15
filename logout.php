<?php
session_start();
echo "your name is " .$_SESSION['username'];
session_unset();
session_destroy();
header("location: index.php");
?>