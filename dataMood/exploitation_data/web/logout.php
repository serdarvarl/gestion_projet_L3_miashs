<?php
session_start();
session_destroy();
header('Location: index.php');
exit;

//require_once 'connexion.php';

// Détruire la session
session_destroy();

// Rediriger vers l'accueil
header('Location: index.php');
exit;
?>