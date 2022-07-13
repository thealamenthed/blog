<?php
session_start();
include('verify-connect.php');

try {
    $bdd = new PDO('mysql:host=localhost;dbname=thealamenthe;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<!-- on teste si les variables du formulaire sont déclarées -->

<?php

if (

    isset($_POST['titre']) &&
    isset($_POST['sous_titre']) &&
    isset($_POST['contenu']) &&
    isset($_POST['image']) &&
    isset($_POST['categorie'])
) {

    // On ajoute une entrée dans la table articles
    $table_articles = $bdd->prepare('INSERT INTO articles (titre, sous_titre, contenu, image, categorie) 
         VALUES(:titre, :sous_titre, :contenu,  :image, :categorie)');
    $response = $table_articles->execute(array(

        'titre' => $_POST['titre'],
        'sous_titre' => $_POST['sous_titre'],
        'contenu' => $_POST['contenu'],
        'image' => $_POST['image'],
        'categorie' => $_POST['categorie'],

    ));

    header('location: edit.php?id=' . $bdd->lastInsertId() . '&success=true');
    exit;
} else {
    echo '...';
}

?>


<?php include 'layouts-admin/head.php'; ?>

<?php include 'layouts-admin/nav.php'; ?>

<!-- Preloader section
================================================== -->
<div class="preloader">

    <div class="sk-spinner sk-spinner-pulse"></div>

</div>

<!-- Header section
================================================== -->
<section id="header" class="header-two">
    <div class="container">
        <div class="row">

            <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
                <div class="header-thumb">
                    <h1 class="wow fadeIn" data-wow-delay="1s">Ajouter un article</h1>
                    <h3 class="wow fadeInUp" data-wow-delay=""></h3>
                </div>
            </div>

        </div>
    </div>
</section>


<section id="single-project">
    <div class="container">
        <div class="row">
            <div>
                <?php if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
                    <div class="alert alert-success">
                        Votre article a bien été ajouté.
                    </div>
                <?php endif; ?>

                <form id="formulaire" method="POST" action="add_article.php?id=">
                    <div class="project-info">
                        <input type="text" name="id" hidden>
                        <div>

                            <div class="form-group">
                                <label for="categorie">Categorie</label>
                                <select id="categorie" name="categorie" class="form-control">
                                    <option value="Recette" selected>Recette</option>
                                    <option value="Design" selected>Design</option>
                                    <option value="Beauté" selected>Beauté</option>
                                    <option value="Home" selected>Home</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="image">Ajouter l'url d'une image</label>
                                <input type="text" class="form-control" name="image" placeholder="Ajouter une image">
                            </div>


                            <div class="form-group">
                                <label for="titre">Titre</label>
                                <input type="text" class="form-control" name="titre" placeholder="titre" />
                            </div>

                            <div class="form-group">
                                <label for="sous_titre">Sous titre</label>
                                <input type="text" class="form-control" name="sous_titre" placeholder="sous-titre" />
                            </div>

                            <div class="form-group">
                                <label for="contenu">Contenu</label>
                                <textarea id="nvx_contenu" name="contenu">
                                </textarea>
                            </div>

                            <button type="submit" class="btn btn-info">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>



<?php include 'layouts-admin/footer.php'; ?>