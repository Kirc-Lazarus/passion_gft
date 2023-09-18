<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
<?php
require_once("../elements/header_abrs.php");
?>
<div class="opacity">
  <!-- Début article de presentation -->
  <h1 class="presentation">Mes acteurs préférés</h1>

  <div class="accueil">
    <!-- Début du conteneur de la section "Accueil" avec la classe CSS "accueil" -->
    <div>
        <!-- Début d'un sous-conteneur -->
        <img class="rounded-circle" src="../img/images-acteurs/brad_pitt.jpg" alt="brad-pitt">
        <!-- Une image affichée sous forme de cercle avec un chemin d'accès spécifié et un texte alternatif -->
    </div>
    <!-- Fin du sous-conteneur -->

    <div class="d-flex align-items-center col-6">
        <!-- Début d'un autre sous-conteneur avec des classes CSS pour la mise en page -->
        <article>
            <!-- Balise "article" pour du contenu textuel -->
            <h2 class="syn">Brad Pitt</h2>
            <!-- Titre de niveau 2 avec la classe "syn" -->
            <!-- Le nom "Brad Pitt" sera affiché à côté de l'image -->
        <p class="presentation1">Il fait partie de ma liste notamment pour son illustre representation dans le film
          l’armée des douze singe sortie en 1995, dans lequel il fait un monologue dans un plan séquence
          anthologique absolument merveilleux...
        </p>
      </article>
    </div>
  </div>
  <div class="accueil ">
    <div class="d-flex align-items-center col-6 ">
      <article>
        <h2 class="syn">Charlize Theron</h2>
        <p class="presentation1">
          Je ne pouvais pas ignorer cette actrice exceptionnelle notamment remarqué dans l’excellent film Monster
          sortie en 2003 avec la participation d’une autre actrice que j’affectionne particulièrement Christina
          Ricci.
        </p>
      </article>
    </div>
    <div>
      <img class="rounded-circle" src="../img/images-acteurs/charlize_theron.png" alt="charlize_theron">
    </div>
  </div>
  <div class="accueil">
    <div>
      <img class="rounded-circle" src="../img/images-acteurs/christopher_walken.jpg" alt="christopher_walken">
    </div>
    <div class="d-flex align-items-center col-6 ">
      <article>
        <h2 class="syn">Christopher Walken</h2>
        <p class="presentation1">
          L’inénarrable Christopher dont la carrière est impressionnante c’est illustré dans de très nombreux films,
          avec une performance très remarqué dans Voyage au bout de l’enfer. Mention spéciale pour son court passage
          dans Pulp-Fiction et son rôle dans Suicid King.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil ">
    <div class="d-flex align-items-center col-6 ">
      <article>
        <h2 class="syn">Havey Keitel</h2>
        <p class="presentation1">
          Un acteur à l’envergure impressionnante, il est dit de lui qu’il est tellement fort qu’il joue même en
          dormant.
          Cet acteur n’a jamais eu d’oscar et c’est assez incompréhensible,
          car il s’est montré plus que convainquant dans de nombreux films avec une performance remarquée dans le
          film Bad Lieutenant.
        </p>
      </article>
    </div>
    <div>
      <img class="rounded-circle" src="../img/images-acteurs/havey_keitel.jpg" alt="havey_keitel">
    </div>
  </div>
  <div class="accueil">
    <div>
      <img class="rounded-circle" src="../img/images-acteurs/kevin_spacey.jpg" alt="kevin_spacey">
    </div>
    <div class="d-flex align-items-center col-6 ">
      <article>
        <h2 class="syn">Kevin Spacey</h2>
        <p class="presentation1">
          Un de mes acteurs favoris je l’ai toujours trouver fort et juste, le film le plus marquant à mon gout est
          de loin,
          La vie de David Gale, un film absolument poignant basée sur une histoire vrai. Sans oublier l’excellent
          Swimming with sharks.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil ">
    <div class="d-flex align-items-center col-6 ">
      <article>
        <h2 class="syn">Michael Madsen</h2>
        <p class="presentation1">
          Un acteur plutôt discret et pourtant très talentueux,
          avec une performance particulière dans le grand Reservoir dogs, j’ai apprécié le voir jouer dans
          l’excellent Frankie la Mouche.
        </p>
      </article>
    </div>
    <div>
      <img class="rounded-circle" src="../img/images-acteurs/michael_madsen.jpg" alt="michael_madsen">
    </div>
  </div>
  <div class="accueil">
    <div>
      <img class="rounded-circle" src="../img/images-acteurs/steve_buscemi.jpg" alt="steve_buscemi">
    </div>
    <div class="d-flex align-items-center col-6">
      <article>
        <h2 class="syn">Steve Buscemi</h2>
        <p class="presentation1">
          Un acteur au visage atypique, plutôt touchant, il est excellent dans Reservoir Dogs,
          mais aussi dans le drôlissime The Big Lebowski, le magnifique Big Fish et l’hilarant L’Incroyable Burt
          Wonderstone
        </p>
      </article>
    </div>
  </div>
  <div class="accueil ">
    <div class="d-flex align-items-center col-6 ">
      <article>
        <h2 class="syn">Takeshi Kitano</h2>
        <p class="presentation1">
          Takeshi Kitano, également connu sous le nom de scène de Beat Takeshi, est un cinéaste, acteur,
          animateur de télévision, humoriste, artiste peintre, et écrivain, né le 18 janvier 1947 dans le quartier
          d'Umejima dans l'arrondissement d'Adachi à Tokyo.
        </p>
      </article>
    </div>
    <div>
      <img class="rounded-circle" src="../img/images-acteurs/takeshi_kitano2.jpg" alt="takeshi_kitano">
    </div>
  </div>
  <div>
    <?php
    require_once("../elements/footer.php");
    ?>