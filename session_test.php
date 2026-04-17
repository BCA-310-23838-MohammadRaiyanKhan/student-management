<?php
session_start();
$_SESSION['test']="OK";
echo $_SESSION['test'];
