<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class TwitterController extends AbstractController
{
    // #[Route('/twitter', name: 'app_twitter')]
    public function login(Connection $connection,Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);
        if(!isset($body['username']) || !isset($body['password'])) 
            return new JsonResponse("entrez des identifiants");
        $username = $body['username'];
        $password = $body['password'];

        $query = "SELECT * FROM users where username = ?";
        $result = $connection->executeQuery($query, [$username]);
        $user = $result->fetchAll();

        if (count($user) == 0)
            return new JsonResponse("identifiant erroné"); 

        $passwordDB = $user[0]["password"];
        if(!password_verify($password, $passwordDB))
            return new JsonResponse("mot de passe incorrect"); 

        $user_id = $user[0]["user_id"];
        $payload = [
            'username' => $username,
            'user_id' => $user_id
        ];
        $key = 'example_key';
        $jwt = JWT::encode($payload, $key, 'HS256');

        return new JsonResponse($jwt);
    }

    public function createPost(Connection $connection,Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);
        if(!isset(getallheaders()['Authorization'])) 
            return new JsonResponse("aucun token dans header Authorization");
        if(!isset($body['content'])) 
            return new JsonResponse("entrez le content");

        $token = $request->headers->get('Authorization');
        $content = $body['content'];
        $key = 'example_key';

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Throwable $th) {
            return new JsonResponse("token incorrect");
        }
        
        $username=$decoded->username;
        $user_id=$decoded->user_id;

        $query = "INSERT INTO posts (user_id,content) VALUES (?,?)";
        $connection->executeQuery($query, [$user_id,$content]);

        return new JsonResponse("post ajouté");
    }

    public function signup(Connection $connection, Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);
        if(!isset($body['username']) || !isset($body['password'])) 
            return new JsonResponse("entrez des identifiants");
        $username = $body['username'];
        $password = $body['password'];
        $query = "INSERT INTO users (username,password) VALUES (?,?)";

        try {
            $connection->executeQuery($query, [$username,password_hash($password, PASSWORD_DEFAULT)]);
        } catch (\Throwable $th) {
            return new JsonResponse("identifiant déja existant");
        }

        return new JsonResponse("inscription réussi");
    }

    public function deletePost($id, Connection $connection): JsonResponse
    {
        $query = "DELETE FROM posts WHERE post_id = ? ";

        try {
            $connection->executeQuery($query, [$id]);
        } catch (\Throwable $th) {
            return new JsonResponse("une erreur est survenue le post n'a pas été supprimé");
        }

        return new JsonResponse("post supprimé ");
    }

    public function post($id, Connection $connection): JsonResponse
    {
        $query = "SELECT * FROM posts WHERE post_id = ? ";
        
        try {
            $result = $connection->executeQuery($query, [$id]);
        } catch (\Throwable $th) {
            return new JsonResponse("une erreur est survenue");
        }
        $post = $result->fetch();
        if (!$post) {
            return new JsonResponse("post non trouvé");
        }
        return new JsonResponse($post);
    }

    public function lastPosts(Connection $connection): JsonResponse
    {
        $query = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 10";
        
        try {
            $result = $connection->executeQuery($query);
        } catch (\Throwable $th) {
            return new JsonResponse("une erreur est survenue");
        }
        $post = $result->fetchAll();
        if (!$post) {
            return new JsonResponse("aucun post");
        }
        return new JsonResponse($post);
    }
}
