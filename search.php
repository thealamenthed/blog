<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=thealamenthe;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$terme = '';
if (isset($_GET['terme'])) {
    $terme = $_GET['terme'];
}

$select_terme = $bdd->prepare('SELECT * FROM articles WHERE titre LIKE ? OR contenu LIKE ?');
$select_terme->execute(array("%" . $terme . "%", "%" . $terme . "%"));


?>

<?php include 'layouts/head.php'; ?>

<?php include 'layouts/nav.php'; ?>


<!-- Header section
================================================== -->
<section id="header" class="header-one">
   <div class="container">
      <div class="row">

         <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
            <div class="header-thumb">
               <h1 class="wow fadeIn" data-wow-delay="">Resultat de votre recherche :</h1>
               <h3 class="wow fadeInUp" data-wow-delay=""><?= $terme ?></h3>

            </div>

            <?php include 'layouts/bdr.php'; ?>
         </div>




      </div>

   </div>

</section>


<div class="container">
    <div class="row">

        <div class="wow fadeInUp col-md-12 col-sm-12" data-wow-delay="1.3s">
            <h1>Interdum et malesuada fames</h1>
            <p>Sed quis laoreet purus, a luctus ligula. Suspendisse nec urna a dolor sodales venenatis. Donec et sem quam. Fusce faucibus neque sit amet arcu auctor tincidunt. Etiam feugiat nibh orci, quis sagittis velit pretium ac. Suspendisse egestas ex a dolor dictum gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sagittis urna id odio consequat fringilla.</p>
            <p>Integer eu rhoncus libero. Nulla dignissim laoreet eros quis interdum. Proin ut placerat dui, eget vehicula ipsum. Mauris id molestie eros. Vestibulum fringilla dui nunc, vitae euismod ligula consectetur eget. Sed accumsan, ipsum in scelerisque euismod, nisi quam placerat urna, ac porttitor augue sapien varius velit.</p>
        </div>

    </div>
</div>


<!-- Portfolio section
================================================== -->
<section id="portfolio">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">

                <!--              iso section 
                <div class="iso-section wow fadeInUp" data-wow-delay="1.6s">

                    <ul class="filter-wrapper clearfix">
                        <li><a href="#" data-filter="*" class="selected opc-main-bg">All</a></li>
                        <li><a href="#" class="opc-main-bg" data-filter=".graphic">Graphic</a></li>
                        <li><a href="#" class="opc-main-bg" data-filter=".template">Web template</a></li>
                        <li><a href="#" class="opc-main-bg" data-filter=".photoshop">Photoshop</a></li>
                        <li><a href="#" class="opc-main-bg" data-filter=".branding">Branding</a></li>
                    </ul> -->

                <!-- iso box section -->


                <?php

                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=thealamenthe;charset=utf8', 'root', 'root');
                } catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
                $reponse = $bdd->query('SELECT * FROM articles ORDER BY id DESC LIMIT 6');
                ?>




                <div class="iso-box-section wow fadeInUp">
                    <div class="iso-box-wrapper col4-iso-box">

                        <?php while ($donnees = $select_terme->fetch()) {  ?>
                            <div class="iso-box <?php echo $donnees['categorie']; ?> col-md-4 col-sm-6">
                                <div class="portfolio-thumb">
                                    <img src="<?php echo $donnees['image']; ?> " class="img-responsive" alt="Portfolio">
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-item">
                                            <a href="single-project.php?id=<?= $donnees['id']; ?>"><i class="fa fa-link"></i></a>
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