<!--    .read chemin fichier 
        php -S 0.0.0.0:8080 -->
<?php
session_start();
$dbh = new PDO('sqlite:database');
// $username = 'admin' ;
// $password= 'mdp' ;
$username = $_POST['username']; 
$password = $_POST['password'];
echo $username;
echo $password;
$query = $dbh->prepare("SELECT count(*) FROM `connexion` where 
user = '".$username."' and password = '".$password."' ");
$query->execute();
$data = $query->fetchAll();
$count = $data[0]['count(*)'];
print_r($count);
if($count!=0) {
    $_SESSION['username'] = $username;
    header('Location: home.php');
} else {
    header('Location: login.php');
}
?>
