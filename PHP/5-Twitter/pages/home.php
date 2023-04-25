<?php
$dbh = new PDO('sqlite:database');
$posts = $dbh->query("select * from posts order by created_at desc limit 10")->fetchAll();

?>
<!doctype html>
<form method="POST" action="index.php?action=createPost">
    <input type="text" name="content" placeholder="your message...">
    <button type="submit">create post</button>
</form>
 <ul>
<?php foreach($posts as $index => $post) {
?>
    <li><?= $post['created_at'] ?> - <?= $post['content'] ?></li>
<?php
} ?>
<a href='index.php?action=logout'><span>Déconnexion</span></a>
</ul> 