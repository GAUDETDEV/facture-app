<?php

if(!isset($_SESSION["password"])){

    header('Location: index.php');

}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Facturation</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="" href="home.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="liste_articles.php" title="Liste des articles ajoutés à la facture"><i class="fa-solid fa-list"></i> 
                <span class="bg-primary rounded-5 p-1 text-white">
                 <?php 
                    include('functions.php');
                    compteurArticles(); 
                  ?> 
                </span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link btn btn-success" href="deconnect.php">Deconnexion <i class="fa-solid fa-right-from-bracket"></i></a>
            </li>
        </ul>
        </div>
    </div>
</nav>
