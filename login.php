<?php
session_start();
// Démarrage de la session

try {
    $bdd = new PDO('mysql:host=localhost;dbname=thealamenthe;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// On inclut la connexion à la base de données

if (!empty($_POST['pseudo']) &&  !empty($_POST['email']) && !empty($_POST['password']))
// Si il existe les champs email, password et qu'il sont pas vident
{
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // On regarde si l'utilisateur est inscrit dans la table utilisateurs
    $check = $bdd->prepare('SELECT * FROM user WHERE `pseudo`=? || `email` = ? AND `password`= ?');
    $check->execute(array($pseudo, $email, $password));
    $data = $check->fetch();
    $row = $check->rowCount();

    // Si > à 0 alors l'utilisateur existe
    if ($row > 0) {
        $_SESSION['loggued'] = true;
        $_SESSION['user'] = $data;
        header("location: admin/index-admin.php"); // redirection sur la page d'accueil d'administrateur
        die();
    } else {
        header('Location: admin/authentification.php?login_err=already');
        die();
    }
} else {
    header('Location: admin/authentification.php');
    die();
} 
    // si le formulaire est envoyé sans aucune données