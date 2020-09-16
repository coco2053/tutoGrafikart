<?php
require_once('header.php');
$pdo = new PDO('mysql:host=localhost;dbname=blog_grafikart;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$error = null;
try {
    $query = $pdo->query('SELECT * FROM post');
    $posts = $query->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    $error = $e->getMessage();
}
?>
<?php if($error) : ?>
    <div class="alert alert-danger"> <?= $error ?> </div>
<?php else: ?>
<ul>
    <?php foreach($posts as $post): ?>
    <li><a href="edit.php?id=<?= $post->id?>"> <?=$post->title ?></a> </li>
    <?php endforeach ?>
</ul>
<?php endif ?>

<?php
require_once('footer.php');
?>
