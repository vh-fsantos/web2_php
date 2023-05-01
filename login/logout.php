<?php

include_once("../common/common.php");

session_start();
if (isset($_SESSION["username"])) 
{
    session_destroy();
    header("location: /index.php");
    exit();
}

?>