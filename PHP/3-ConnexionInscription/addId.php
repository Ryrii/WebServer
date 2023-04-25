<?php
session_start();
$dbh = new PDO('sqlite:database');
$username = $_POST['username']; 
$password = $_POST['password'];
echo $username;
echo $password;
try {
    $query = $dbh->prepare("INSERT INTO connexion VALUES ('".$username."', '".$password."')");
    $query->execute();
    header('Location: login.php');
} catch (\Throwable $th) {
    //throw $th;
}

?>
