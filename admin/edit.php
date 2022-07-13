<?php
session_start();
include('verify-connect.php');

$articleId = $_GET['id'];

try {
    $bdd = new PDO('mysql:host=localhost;dbname=thealamenthe;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM articles WHERE id = "' . $articleId . '"')->fetch();

if (
    isset($_POST['nvx_titre']) &&
    isset($_POST['nvx_sous_titre']) &&
    isset($_POST['nvx_contenu']) &&
    isset($_POST['nvx_categorie']) &&
    isset($_POST['nvx_image'])
) {

    $post_id = $_POST['id'];
    $nvx_titre = $_POST['nvx_titre'];
    $nvx_sous_titre = $_POST['nvx_sous_titre'];
    $nvx_contenu = $_POST['nvx_contenu'];
    $nvx_image = $_POST['nvx_image'];
    $nvx_categorie = $_POST['nvx_categorie'];

    $modif_article = $bdd->prepare('UPDATE articles SET 
        `titre` = :nvx_titre, 
        `sous_titre` = :nvx_sous_titre, 
        `contenu` = :nvx_contenu, 
        `categorie` = :nvx_categorie,
        `image` = :nvx_image 
        WHERE id = :post_id ');

    $modif_article->execute([
        ':nvx_titre' => $nvx_titre,
        ':nvx_sous_titre' => $nvx_sous_titre,
        ':nvx_contenu' => $nvx_contenu,
        ':nvx_image' => $nvx_image,
        ':nvx_categorie' => $nvx_categorie,
        ':post_id' => $post_id
    ]);

    header('location: edit.php?id=' . $post_id . '&success=true');
    exit;
} else {
    echo '';
}

//on récupère l'id dans l'url afin d'afficher les données dans le formulaire.

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
                    <h1 class="wow fadeIn" data-wow-delay="1.s">Edit</h1>
                    <h3 class="wow fadeInUp" data-wow-delay="1.s"></h3>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Modification -->
<h2>Modification article </h2>

<section id="single-project">
    <div class="container">
        <div class="row">
            <div>
                <?php if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
                    <div class="alert alert-success">
                        Votre article a bien été modifié.
                    </div>
                <?php endif; ?>

                <form id="formulaire" method="POST" action="edit.php?id=<?php echo $reponse['id']; ?>">
                    <div class="project-info">
                        <input type="hidden" name="id" value="<?php echo $reponse['id']; ?>">
                        <div>
                            <div class="form-group">
                                <img style="width: 140px;" height="140" class="img-thumbnail" src="<?php echo $reponse['image']; ?>" alt="cover img" />
                            </div>

                            <div class="form-group">
                                <label for="nvx_categorie">Categorie</label>
                                <select id="nvx_categorie" name="nvx_categorie" class="form-control">
                                    <option value="Recette" <?php if ($reponse['categorie'] === 'Recette') : ?>selected<?php endif; ?>>Recette</option>
                                    <option value="Design" <?php if ($reponse['categorie'] === 'Design') : ?>selected<?php endif; ?>>Design</option>
                                    <option value="Beauté" <?php if ($reponse['categorie'] === 'Beauté') : ?>selected<?php endif; ?>>Beauté</option>
                                    <option value="Home" <?php if ($reponse['categorie'] === 'Home') : ?>selected<?php endif; ?>>Home</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nvx_image">Ajouter l'url d'une image</label>
                                <input type="text" class="form-control" id="nvx_image" name="nvx_image" value="<?php echo $reponse['image']; ?>" placeholder="https://exemple.jpg">
                            </div>

                            <div class="form-group">
                                <label for="nvx_titre">Titre</label>
                                <input type="text" class="form-control" id="nvx_titre" name="nvx_titre" value="<?php echo $reponse['titre']; ?>" placeholder="Titre de l'article">
                            </div>

                            <div class="form-group">
                                <label for="nvx_sous_titre">Sous titre</label>
                                <input type="text" class="form-control" id="nvx_sous_titre" name="nvx_sous_titre" value="<?php echo $reponse['sous_titre']; ?>" placeholder="Titre de l'article">
                            </div>

                            <div class="form-group">
                                <label for="nvx_contenu">Contenu</label>
                                <textarea id="nvx_contenu" name="nvx_contenu">
                                <?php echo $reponse['contenu']; ?>
                            </textarea>
                            </div>
                            <button type="submit" class="btn btn-info">
                                Modifier
                            </button>

                            <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                Supprimer
                            </a>

                            <a href="../single-project.php?id=<?= $reponse['id']; ?>" type="button" class="btn btn-warning">
                                Aperçu
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Supprimer l'article</h4>
            </div>
            <div class="modal-body">
                <p>Souhaitez vous vraiment supprimer cette article ?</p>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-info" data-dismiss="modal">Annuler</a>
                <a href="delete.php?id=<?= $reponse['id'] ?>" class="btn btn-danger">Supprimer</a>
            </div>
        </div>

    </div>
</div>

<?php include 'layouts-admin/footer.php'; ?>