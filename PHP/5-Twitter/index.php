<?php
session_start();
print_r($_SESSION);

$actions = require('actions.php');
if (isset($_GET['action'])) {
   	$actions[$_GET['action']]();
}

$page = isset($_SESSION["connected"]) && $_SESSION["connected"] ? 'home' : 'login';

require("pages/$page.php");



