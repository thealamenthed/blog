<?php session_start();

$articleId = $_GET['id'];

try {
    $bdd = new PDO('mysql:host=localhost;dbname=thealamenthe;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$bdd->query('DELETE FROM articles WHERE id = "' . $articleId . '"')->execute();

header('location: index-admin.php?id=' . $post_id . '&delete=true');
exit;
