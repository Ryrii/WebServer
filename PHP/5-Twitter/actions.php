<?php
return [
    'createUser' => function () {
        $username = $_POST['username']; 
        $password = $_POST['password'];
        $dbh = new PDO('sqlite:database');
        $query = $dbh->prepare("INSERT INTO users (username,password)
        VALUES (?,?)");
        try {
            $query->execute([$username,$password]);
            echo "inscription réussi";
        } catch (\Throwable $th) {
            echo "inscription échoué";
        }



	},
    'login' => function () {
        if (isset($_POST['username'])&&($_POST['password'])){
    
            $username = $_POST['username']; 
            $password = $_POST['password'];
            $dbh = new PDO('sqlite:database');
            $query = $dbh->prepare("SELECT * FROM users where username = ? and password = ?");
            $query->execute([$username,$password]);
            $data = $query->fetchAll();
            if (count($data) != 0) {
                $_SESSION["userId"] = $data[0]['user_id'];
                $_SESSION["connected"] = true;
                echo "connexion réussi";
            }else{
                echo "identifiants incorects";
            }
        }
        
    },    
    'logout' => function () {
		session_unset();
		header("Location: index.php");
	},
    'createPost' => function () {
        $content = $_POST['content'];
        $dbh = new PDO('sqlite:database');
        $user_id = $_SESSION["userId"];
        $query = $dbh->prepare("INSERT INTO posts (user_id,content)
        VALUES (?,?)");
        try {
            $query->execute([$user_id,$content]);
            echo "post ajouté";
        } catch (\Throwable $th) {
            echo "l'ajout du post a échoué";
        }

	}
];
?>