<?php
session_start();
?>
<?php include 'layouts-admin/head.php'; ?>

<body>

    <section class="h-100 gradient-form " style="background-color: #cedadf;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0 login">
                            <div class="col-lg-12">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center img-logo">
                                        <a href="../index.php"><img src="../images/logo.png" style="width: 185px;" alt="logo"></a>

                                    </div>

                                    <form method="POST" action="../login.php">
                                        <div class="form-outline mb-4">
                                            <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="pseudo" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="email" name="email" class="form-control" placeholder="email address" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example22" name="password" class="form-control" placeholder="mot de passe" />
                                        </div>

                                        <!-- si le paramètre (url) login existe, et qu'il est égale a already alors affiche moi echo -->
                                        <?php
                                        if (isset($_GET['login_err']) && $_GET['login_err'] === 'already') {
                                            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                                        }
                                        ?>

                                        <div class="d-flex align-items-center justify-content-center pb-4 ">
                                            <button type="submit" class="btn btn-outline-success btn-login">Connexion</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>