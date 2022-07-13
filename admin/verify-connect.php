<?php

if (!isset($_SESSION['loggued'])) {
    header('Location: authentification.php');
    die();
}
