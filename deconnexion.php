<?php
session_start();
session_destroy();
unset($_SESSION);

var_dump($_SESSION);
header("Location: index.php");





?>