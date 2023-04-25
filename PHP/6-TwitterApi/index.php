<?php
session_start();
$endpoints = [
    '/signup' => function () {
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
    '/login' => function () {
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
                print_r($_SESSION);

            }else{
                echo "identifiants incorects";
            }
        }
        
    },    
    '/logout' => function () {
		session_unset();
		echo 'deconecté';
	},
    '/createPost' => function () {
        $content = $_POST['content'];
        $user_id =$_POST['userId'];
        $dbh = new PDO('sqlite:database');
        $query = $dbh->prepare("INSERT INTO posts (user_id,content)
        VALUES (?,?)");
        try {
            $query->execute([$user_id,$content]);
            echo "post ajouté";
        } catch (\Throwable $th) {
            echo "l'ajout du post a échoué";
        }

	},
    "/deletePost/([0-9]+)" => function ($id) {
        $dbh = new PDO('sqlite:database');
        $query = $dbh->prepare("DELETE FROM posts WHERE post_id=?");
        $query->execute([$id]);
        echo "post supprimé";

    },    
    "/post/([0-9]+)" => function ($id) {
        $dbh = new PDO('sqlite:database');
        $query = $dbh->prepare("SELECT * FROM posts WHERE post_id=? ");
        $query->execute([$id]);
        $data = $query->fetch();
        print_r($data);

    },
    "/lastPosts" => function () {
        $dbh = new PDO('sqlite:database');
        $query = $dbh->prepare("SELECT * FROM posts ORDER BY created_at DESC LIMIT 10");
        $query->execute();
        $data = $query->fetchAll();
        print_r($data);

    }
    
];
$path = $_SERVER['REQUEST_URI'];
foreach ($endpoints as $pattern => $endpoint) {
    if (preg_match("#^$pattern$#", $path, $matches)) {
        array_shift($matches);
        call_user_func_array($endpoint, $matches);
    }
}

?>
