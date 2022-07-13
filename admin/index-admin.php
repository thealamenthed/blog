<?php
session_start();

include('verify-connect.php');

try {
    $bdd = new PDO('mysql:host=localhost;dbname=thealamenthe;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM articles ORDER BY id DESC');
?>

<?php include 'layouts-admin/head.php'; ?>

<?php include 'layouts-admin/nav.php'; ?>

<?php include 'layouts-admin/header-section.php'; ?>

<!-- Portfolio section
================================================== -->
<section id="portfolio">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">

                <!-- iso section -->
                <div class="iso-section wow fadeInUp">

                    <?php if (isset($_GET['delete']) && $_GET['delete'] == 'true') : ?>
                        <div class="alert alert-success">
                            Votre article a été supprimé avec succès.
                        </div>
                    <?php endif; ?>

                    <ul class="clearfix">
                        <li><a href="add_article.php" class="add-article">Ajouter un article</a></li>
                    </ul>

                    <!-- iso box section -->
                    <div class="iso-box-section wow fadeInUp" data-wow-delay="1s">
                        <div class="iso-box-wrapper col4-iso-box" style="margin-top: 30px">

                            <?php while ($donnees = $reponse->fetch()) {  ?>
                                <div class="iso-box <?php echo $donnees['categorie']; ?> col-md-4 col-sm-6">
                                    <div class="portfolio-thumb">
                                        <img src="<?php echo $donnees['image']; ?>" class="img-responsive" alt="Portfolio">
                                        <div class="portfolio-overlay">
                                            <div class="portfolio-item">
                                                <a href="edit.php?id=<?= $donnees['id']; ?>"><i class="fa fa-pencil"></i></a>
                                                <h2><?php echo $donnees['titre']; ?></h2>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
</section>


<?php include 'layouts-admin/footer.php'; ?>