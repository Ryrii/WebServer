<?php
 session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>PAGE UTILISATEUR</h1>
   
<?php
 if(isset($_GET['deconnexion']) && $_GET['deconnexion']==true){
    session_unset();
    header("location:login.php");
}
if(isset($_SESSION['username']) && $_SESSION['username'] !== ""){
    $user = $_SESSION['username'];
    echo "Bonjour $user, vous êtes connecté";
}else{
    header("location:login.php");
}
?>
<br>
<a href='home.php?deconnexion=true'><span>Déconnexion</span></a>
</body>
</html>