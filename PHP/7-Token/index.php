<?php
$endpoints = [
    "/connect" => function()
    {
        $dbh = new PDO('sqlite:database');

        $username = $_POST['username']; 
        $password = $_POST['password'];

        $query = $dbh->prepare("SELECT * FROM users where username = ? and password = ?");
        $query->execute([$username,$password]);
        $data = $query->fetchAll();
        if (count($data) != 0) {
            $user_id = $data[0]["user_id"];
            $token = bin2hex(random_bytes(32));
            $query = $dbh->prepare("DELETE FROM token WHERE validity < date('now')");
            $query->execute();
            $query = $dbh->prepare("REPLACE INTO token VALUES (?,?,date('now','+2 day')) ");
            $query->execute([$user_id,$token]);
            echo($token);
        }else {
            echo "identifiants erronés";
            }
        
    },
    "/createPost" =>  function()
    {
        $token = $_POST['token'];
        $content = $_POST['content'];

        $dbh = new PDO('sqlite:database');
        $query = $dbh->prepare("SELECT * FROM token where token = ? ");
        $query->execute([$token]);
        $data = $query->fetchAll();
        if (count($data) != 0) {
            $user_id = $data[0]["user_id"];
            $query = $dbh->prepare("INSERT INTO posts (user_id,content)
            VALUES (?,?)");
            $query->execute([$user_id,$content]);
            $query = $dbh->prepare("SELECT * FROM posts where user_id = ?");
            $query->execute([$user_id]);
            $data = $query->fetchAll();
            print_r($data);
        }else {
             echo "impossible de poster le message";
            }
    }
];
$path = $_SERVER['REQUEST_URI'];
if (array_key_exists($path, $endpoints)) {
    $endpoint = $endpoints[$_SERVER['REQUEST_URI']];
    $endpoint();
}


?>
