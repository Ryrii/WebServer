<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


$endpoints = [
    "/login" => function()
    {

        $body = json_decode(file_get_contents('php://input'), TRUE);

        if(isset($body['username'])&&isset($body['password'])) {
            $username = $body['username']; 
            $password = $body['password'];
        }else {
            echo "entrez des identifiants";
            return 0;
        }
        $dbh = new PDO('sqlite:database');
        $query = $dbh->prepare("SELECT * FROM users where username = ? and password = ?");
        $query->execute([$username,$password]);
        $data = $query->fetchAll();
        if (count($data) != 0) {
            $user_id = $data[0]["user_id"];
            
            $payload = [
                'username' => $username,
                'user_id' => $user_id
            ];
            $key = 'example_key';
            $jwt = JWT::encode($payload, $key, 'HS256');
            echo($jwt);
        }else {
            echo "identifiants erronés";
            }
        
    },
    "/createPost" =>  function()
    {
        $body = json_decode(file_get_contents('php://input'), TRUE);
        if(isset(getallheaders()['Authorization'])) {
            $token = getallheaders()['Authorization'];
        }else {
            echo "aucun token dans header Authorization";
            return 0;
        }

        $content = $body['content'];
        $key = 'example_key';

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            print_r($decoded);
            $username=$decoded->username;
            $user_id=$decoded->user_id;

            $dbh = new PDO('sqlite:database');
            $query = $dbh->prepare("INSERT INTO posts (user_id,content)
            VALUES (?,?)");
            $query->execute([$user_id,$content]);
            $query = $dbh->prepare("SELECT * FROM posts where user_id = ?");
            $query->execute([$user_id]);
            $data = $query->fetchAll();
            print_r($data);
        }catch(Exception $e) {
             echo "impossible de poster le message veuillez vous connecter";
            
            }
    }
];
$path = $_SERVER['REQUEST_URI'];
if (array_key_exists($path, $endpoints)) {
    $endpoint = $endpoints[$_SERVER['REQUEST_URI']];
    $endpoint();
}


?>
