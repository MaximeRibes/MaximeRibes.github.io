<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet"> 
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery-3.3.1.slim.min.js"></script>
        <script src="js/js.js"></script>
        <title>Portfolio Maxime Ribes</title>
        <link rel="icon" type="image/x-icon" href="assets/img/m.png" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/01e96949f9.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- Barre de navigation-->
        <header class="header">
            <nav class="navbar navbar-expand-lg fixed-top py-3">
                <div class="container"><a class="navbar-brand text-uppercase font-weight-bold">MR</a>
                    <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
                    
                    <div id="navbarSupportedContent" class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a href="index.html" class="nav-link text-uppercase font-weight-bold">Accueil</a></li>
                            <li class="nav-item"><a href="entreprise.html" class="nav-link text-uppercase font-weight-bold">Entreprise</a></li>
                            <li class="nav-item"><a href="projets.html" class="nav-link text-uppercase font-weight-bold">Projets</a></li>
                            <li class="nav-item"><a href="veille.php" class="nav-link text-uppercase font-weight-bold">Veille</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
        <div class="container">
                <h1>Intelligence artificielle</h1>
            </div>
            <div class="container" style="margin-bottom: 30px; margin-top: 30px;">
            <a>Trier par : </a><select id="sort" name="sort" onchange="sortArticles()">
                    <option value="" selected=""> Choisissez une option de tri </option>
                    <option value="dateDesc"> + recent au - </option>
                    <option value="pertDesc"> + pertinent au - </option>
                </select>
            </div>
            <div class="containerarticle">
            <?php session_start();
                $bdd = new PDO('mysql:host=localhost;dbname=u542287388_portfolio;charset=utf8;', 'u542287388_maxime', 'Marseille78126!');
                $veille = $bdd->query('SELECT * FROM articles');
                while($id = $veille->fetch()) {?>
                    <div class="articles">
                        <div class="titre">
                            <h3><?php echo $id['titre'] ?></h3>
                        </div>
                        <div class="image">
                            <img src="assets/img/veille/<?php echo $id['img'] ?>" alt="">
                        </div>
                        <div class="resume">
                            <p><?php echo $id['resume'] ?></p>
                        </div>
                        <div class="date">
                            <p><?php echo $id['date'] ?></p>
                        </div>
                        <div class="pertinence">
                            <p><?php 
                            if($id['pertinence'] == 1) {
                                ?><img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-vide.png">
                                <img src="assets/img/veille/star-vide.png">
                                <img src="assets/img/veille/star-vide.png">
                                <img src="assets/img/veille/star-vide.png">
                                <?php 
                            } elseif($id['pertinence'] == 2) {
                                ?><img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-vide.png">
                                <img src="assets/img/veille/star-vide.png">
                                <img src="assets/img/veille/star-vide.png">
                                <?php 
                            } elseif($id['pertinence'] == 3) {
                                ?><img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-vide.png">
                                <img src="assets/img/veille/star-vide.png">
                                <?php 
                            } elseif($id['pertinence'] == 4) {
                                ?><img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-vide.png">
                                <?php 
                            } else {
                                ?><img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-pleine.png">
                                <img src="assets/img/veille/star-pleine.png">
                                <?php 
                            } ?></p>
                        </div>
                        <div class="lien">
                            <p><a href="<?php echo $id['lien'] ?>">Lien vers l'article</a></p>
                        </div>
                    </div>
                <?php }?>
                </div>
                <footer>
            <div class="col-lg-4 text-lg-left">Tous droits réservés © MaximeRibes 2021</div>
                <a class="btn btn-dark btn-social mx-2" href="https://www.linkedin.com/in/maxime-ribes/"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="https://github.com/MaximeRibes/"><i class="fab fa-github"></i></a>          
                <a class="btn btn-dark btn-social mx-2" href="https://gitlab.com/MaximeRibes/"><i class="fab fa-gitlab"></i></a>  
                <div class="col-lg-4 text-lg-right"><a href="assets\img\mentions_legales.pdf">Mentions légales</a></div>
        </footer>  
        </main>
    </body>
</html>