<?php session_start(); 


try {
    $bdd = new PDO('mysql:host=localhost;dbname=thealamenthe;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM articles ORDER BY id DESC LIMIT 6');
?>

<?php include 'layouts/head.php'; ?>

<?php include 'layouts/nav.php'; ?>

<?php include 'layouts/header-section.php'; ?>

<!-- Portfolio section
================================================== -->
<section id="portfolio">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">

                <!-- iso section -->
                <div class="iso-section wow fadeInUp" data-wow-delay="">

                    <ul class="filter-wrapper clearfix">
                        <li><a href="#" data-filter="*" class="selected opc-main-bg">All</a></li>
                        <li><a href="#" class="opc-main-bg" data-filter=".Home">Home</a></li>
                        <li><a href="#" class="opc-main-bg" data-filter=".Design">Design</a></li>
                        <li><a href="#" class="opc-main-bg" data-filter=".Beauté">Beauté</a></li>
                        <li><a href="#" class="opc-main-bg" data-filter=".Recette">Recette</a></li>
                        
                    </ul>

                    <!-- iso box section -->
                        <div class="iso-box-section wow fadeInUp">
                            <div class="iso-box-wrapper col4-iso-box">
                                
                            <?php while ($donnees = $reponse->fetch()) {  ?>
                                <div class="iso-box <?php echo $donnees['categorie']; ?> col-md-4 col-sm-6">
                                    <div class="portfolio-thumb">
                                        <img src="<?php echo $donnees['image']; ?> " class="img-responsive" alt="Portfolio">
                                        <div class="portfolio-overlay">
                                            <div class="portfolio-item">
                                                <a href="single-project.php?id=<?= $donnees['id'];?>"><i class="fa fa-link"></i></a>
                                                <h2><?php echo $donnees['titre']; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'layouts/footer.php'; ?>