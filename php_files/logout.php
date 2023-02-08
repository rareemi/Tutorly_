<?php
session_start();
if(session_destroy())
{
header("Location:..\php_files\index.php");
}
?>