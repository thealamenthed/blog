<?php
session_start();

$articleId = $_GET['id'];

try {
	$bdd = new PDO('mysql:host=localhost;dbname=thealamenthe;charset=utf8', 'root', 'root');
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM articles WHERE id = "' . $articleId . '"')->fetch();
?>

<?php include 'layouts/head.php'; ?>

<?php include 'layouts/nav.php'; ?>


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
					<h1 class="wow fadeIn" data-wow-delay="1"><?php echo $reponse['titre']; ?></h1>
					<h3 class="wow fadeInUp" data-wow-delay="1s"><?php echo $reponse['sous_titre']; ?></h3>
				</div>
			</div>

		</div>
	</div>
</section>

<!-- Single Project section
================================================== -->
<section id="single-project">
	<div class="container">
		<div class="row">

			<div class="wow fadeInUp col-md-offset-1 col-md-3 col-sm-offset-1 col-sm-4" data-wow-delay="1s">
				<div class="project-info">
					<h4><?php echo $reponse['titre']; ?></h4>
					<p><?php echo $reponse['sous_titre']; ?></hp>
				</div>
				<div class="project-info">
					<h4>Date</h4>
					<p><?php echo (new DateTime($reponse['dateTimeCreate']))->format('d/m/Y'); ?></p>
				</div>
				<div class="project-info">
					<h4>Category</h4>
					<p><?php echo $reponse['categorie']; ?></p>
				</div>
			</div>

			<div class="wow fadeInUp col-md-7 col-sm-7" data-wow-delay="2.6s">
				<p><?php echo $reponse['contenu']; ?></p>
				<img src="<?php echo $reponse['image']; ?>" class="img-responsive" alt="Single Project">
			</div>

		</div>
	</div>
</section>

<?php include 'layouts/footer.php'; ?>