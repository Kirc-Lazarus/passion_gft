<?php
require_once("elements/header.php");
?>
<div class="globale">
    <div class="accueil">
        <!-- Un élément <div> avec la classe "accueil" pour la section d'accueil. -->
        <div class="menu">
            <!-- Un élément <div> avec la classe "menu" pour le menu principal. -->

            <!-- Carousel -->
            <div id="demo" class="carousel slide" data-bs-ride="carousel">
                <!-- Un élément <div> avec un identifiant "demo" pour le carousel (diaporama) avec le support des transitions automatiques. -->

                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <!-- Les indicateurs/dots pour le carousel (points de navigation). -->
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <!-- Un bouton pour le premier diapositive (indice 0), marqué comme actif (active). -->
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <!-- Un bouton pour le deuxième diapositive (indice 1). -->
                    <?php if (isset($_SESSION['auth'])) : ?>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    <?php endif; ?>
                    <!-- Un bouton pour le troisième diapositive (indice 2). -->
                </div>
                <!-- The slideshow/carousel -->
                <!-- Le diaporama/carousel lui-même. -->
                <div class="carousel-inner">
                    <!-- Une liste des éléments de diapositives. -->
                    <div class="carousel-item active">
                        <!-- La première diapositive, marquée comme active. -->
                        <a href="inc/realisateurs.php">
                            <!-- Un lien vers la page "realisateurs.html". -->
                            <img src="img/realisateurs.jpg" alt="Un homme avec une caméra" class="d-block" style="width: 100%" />
                            <!-- Une image de la première diapositive. -->
                        </a>
                        <div class="carousel-caption">
                            <!-- La légende/caption pour la première diapositive. -->
                            <h2><span class="badge bg-dark">Realisateurs</span></h2>
                            <!-- Un badge de style pour indiquer le type de contenu (Réalisateurs). -->
                        </div>
                    </div>
                    <!-- Les autres diapositives suivent un modèle similaire. -->
                    <?php if (isset($_SESSION['auth'])) : ?>
                        <div class="carousel-item">
                            <a href="inc/selection.php">
                                <img src="img/films.jpg" alt="Une salle de cinéma" class="d-block" style="width: 100%" />
                            </a>
                            <div class="carousel-caption">
                                <h2><span class="badge bg-dark">Films</span></h2>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="carousel-item">
                        <a href="inc/acteurs.php">
                            <img src="img/acteurs.jpg" alt="Alain Chabat et Gérard Darmon qui chante la Carioca" class="d-block" style="width: 100%" />
                        </a>
                        <div class="carousel-caption">
                            <h2><span class="badge bg-dark">Acteurs</span></h2>
                        </div>
                    </div>
                </div>
                <!-- Left and right controls/icons -->
                <!-- Les boutons de contrôle gauche et droite pour naviguer dans le diaporama. -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </div>
    <!-- Début article de presentation -->
    <div>
        <!-- Un élément <div> avec la classe "" pour le conteneur du texte avec une couleur spécifique. -->
        <article class="presentation">
            <!-- Un élément <article> avec la classe "presentation" pour le contenu de presentation. -->
            <h2>Synopsis</h2>
            <!-- Un titre de niveau 2 (H2) avec la classe "syn" pour indiquer le titre "Synopsis". -->
            Bienvenue dans le monde merveilleux de mon goût du cinéma, <br />
            vous allez découvrir ici l'étrange univers de ma jeunesse dans la
            découverte et l'épanouissement cinématographique. <br />
            Peut-être prendrez-vous plaisir dans l'exploration de paysages
            inconnus jusqu'alors. <br />
            J'espère vous émerveiller, vous ravir, vous surprendre et ou vous
            choquer. <br />
            En vous souhaitant une belle visite.
        </article>
    </div>
</div>
<!-- Fin article de presentation -->
<?php
require_once("elements/footer.php");
?>