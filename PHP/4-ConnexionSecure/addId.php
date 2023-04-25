<?php
session_start();
$dbh = new PDO('sqlite:database');
$username = $_POST['username']; 
$password = $_POST['password'];
try {
    $query = $dbh->prepare("INSERT INTO connexion VALUES (?, ?)");
    $query->execute([$username,password_hash($password, PASSWORD_DEFAULT)]);
    header('Location: login.php');
} catch (\Throwable $th) {

}

?>
