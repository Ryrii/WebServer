<?php
session_start();
$dbh = new PDO('sqlite:database');
$username = $_POST['username']; 
$password = $_POST['password'];
echo $username;
echo $password;
$query = $dbh->prepare("SELECT * FROM connexion where 
user = ? ");
$query->execute([$username]);
$data = $query->fetch();
$p = $data[0];
print_r($data);
if(password_verify($password, $data["password"])) {
    $_SESSION['username'] = $username;
    header('Location: home.php');
} else {
    header('Location: login.php');
}
?>
