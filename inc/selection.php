<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
require_once '../elements/functions.php';
// Fonction pour vérifier si une connection est en court et que l'utilisateur peut bien accéder à la page
logged_only();
?>
<?php
require_once("../elements/header_abrs.php");
?>
<div class="opacity">
  <!-- Début article de presentation -->
  <h1 class="presentation">Ma sélection de films</h1>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/18869530.jpg" alt="brad-pitt" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Reservoir Dogs</h2>
        <p>
          Dans un restaurant, huit hommes, en apparence décontractés,
          parlent, entre autres, de musique, notamment de Like a Virgin de
          Madonna, et du fait de savoir s'il faut laisser, ou non, un
          pourboire à la serveuse. Six d'entre eux utilisent des
          pseudonymes (M. White, M. Blonde, M. Orange, M. Pink, M. Blue et
          M. Brown) et les deux autres sont Joe Cabot, un truand de Los
          Angeles, et son fils Eddie.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/515RJH9E9HL._AC_SY445_.jpg" alt="charlize_theron" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Swimming with sharks</h2>
        <p>
          Immersion dans le milieu de la production à Hollywood à travers
          les mésaventures d'un assistant auprès d'un grand patron du
          cinema. Ce dernier est un stratège politique corrompu jusqu'à la
          moëlle et un manipulateur de génie.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/51EX4RSWX1L._AC_SY445_.jpg" alt="christopher_walken" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">La Cité de la peur</h2>
        <p>
          Le film commence sur une projection des dernières minutes de Red
          Is Dead, un film d'horreur nanardesque dans lequel un tueur en
          série communiste tue ses victimes à la faucille et au marteau, à
          l'occasion du premier jour du festival de Cannes. Lorsque le
          générique de fin apparaît, tout le monde a déjà quitté la salle
          au grand désespoir d'Odile Deray, l'attachée de presse, qui
          essaie de retenir un dernier critique de cinéma en le suppliant
          d'écrire un bon papier mais celui-ci refuse. Alors qu'Odile
          quitte le cinéma dépitée, le projectionniste du film est
          assassiné par un tueur de la même façon que dans le film.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/61d9jWYXx-L._AC_SY606_.jpg" alt="havey_keitel" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Les Blues Brothers</h2>
        <p>
          Les frères « Joliet » Jake et Elwood BluesN 1 sont deux
          délinquants stoïques, imperturbables, flegmatiques et drôles,
          reconnaissables à leur look caractéristique composé d'un chapeau
          noir, d'un costume noir, de lunettes noires et de chaussettes
          blanches. Ils se retrouvent lorsque Jake, incarcéré pour vol à
          main armée, est libéré de la prison de Joliet dans l'Illinois
          sous la responsabilité d'Elwood. Ils apprennent alors que
          l'orphelinat catholique où ils ont été élevés est surendetté et
          va être rasé. La seule solution est de payer les arriérés de
          taxes foncières au bureau administratif des impôts de Chicago
          dans un délai de onze jours.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/832457_poster_scale_480x640.jpg" alt="kevin_spacey" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Frankie la Mouche</h2>
        <p>
          Un petit truand à la solde d'un gangster ne songe qu'à se venger
          lorsque ce dernier lui vole la femme de sa vie.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/8518538-1309361441-939134.jpg" alt="michael_madsen" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Braindead</h2>
        <p>
          Lionel Cosgrove, un jeune homme timide flanqué d'une mère
          envahissante fait la connaissance de la belle Paquita, dont il
          tombe amoureux. Ce qui n'est pas du goût de sa chère maman, bien
          décidée à gâcher cette relation. Alors qu'elle espionne l'un de
          leurs rendez-vous galants au zoo, cette dernière est mordue par
          un singe-rat de Sumatra. Succombant à ses blessures, elle se
          transforme alors en zombie cannibale et contamine peu à peu la
          ville. Seul Lionel peut stopper l'invasion.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/a2f1d4ccc95e566e027aa2e70567cad812ba7438083357e8c1be147703e69381._RI_V_TTW_.jpg" alt="steve_buscemi" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Chat noir Chat blanc</h2>
        <p>
          Dans un village gitan, Matko vit comme il peut de petits trafics
          qu'il organise avec son fils, Zare. Pas très malin, Matko flaire
          souvent des combines qui finissent par se retourner contre lui.
          Cette fois, il projette de détourner un train qui transporte de
          l'essence.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/affiche-big-fish.jpg" alt="takeshi_kitano" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Big Fish</h2>
        <p>
          Alors que l'on célèbre le mariage de son fils William, Edward
          Bloom raconte, pour la énième fois, mais avec talent, comment,
          le jour de la naissance de Will, il a attrapé un énorme poisson
          en utilisant comme appât sa propre alliance. Will est embarrassé
          et explique à son épouse, Joséphine, qu'à cause des mensonges
          que raconte son père sur tous les sujets, il ne peut lui faire
          confiance. Par la suite, les relations entre le père et le fils
          deviennent si tendues qu'ils ne se parlent pas durant trois ans.
          Mais, quand il apprend que son père est mourant, Will vient le
          voir en compagnie de Joséphine, enceinte. Dans l'avion qui le
          mène en Alabama, Will se remémore une histoire de son père où il
          prétendait qu'étant petit il s'était aventuré dans un marais et
          avait rencontré une sorcière qui lui avait dévoilé l'instant de
          sa mort dans son œil de verre.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/affiche.jpg" alt="steve_buscemi" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Visitor Q</h2>
        <p>
          L'histoire est celle d'une famille totalement déjantée : le père
          cherche à faire de sa vie un documentaire à succès, le fils
          maltraite sa mère et se fait lui-même maltraiter à l'école, la
          fille se prostitue et accepte son père comme client, la mère se
          prostitue (également) pour s'acheter de la drogue et se découvre
          une passion pour son lait maternel.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/arton46680.jpg" alt="Quentin Tarantino" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">C’est arrive pres de chez vous</h2>
        <p>
          Ben est un tueur en série plein d'esprit et charismatique mais
          narcissique et colérique qui parle longuement de tout ce qui lui
          vient à l'esprit, que ce soit le « métier » de tueur,
          l'architecture, la poésie ou la musique classique qu'il joue
          avec sa petite amie Valérie. Une équipe de tournage se joint à
          lui dans ses aventures sadiques, les enregistrant pour un
          documentaire. Ben leur présente sa famille et ses amis et se
          vante d'avoir assassiné de nombreuses personnes et d'avoir jeté
          leurs corps dans des canaux et des carrières.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/arton7114.jpg" alt="steve_buscemi" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Funny Games</h2>
        <p>
          Un couple, leur fils et leur chien partent passer quelques jours
          dans leur maison de campagne près d'un lac. En passant devant la
          maison de leurs voisins, ils s'étonnent de la présence de deux
          jeunes hommes. À peine arrivés dans leur propre maison de
          campagne, l'un de ces deux jeunes vient leur demander un
          service. Il se comporte avec une grande politesse mais son
          attitude suscite un certain malaise, d'autant plus qu'on ne
          comprend pas comment il a réussi à entrer dans la demeure.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/c6058150cc21d52a4b93525e59f35f1ca5ed4fd47456f76a9c624932ede1236b._RI_V_TTW_.jpg" alt="Quentin Tarantino" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Zatoichi</h2>
        <p>
          Dans le Japon des samouraïs, Zatoïchi est un voyageur aveugle,
          dont les yeux restent fermés, qui gagne sa vie en tant que
          joueur professionnel et masseur. Mais son handicap dissimule un
          guerrier stupéfiant dont l'extrême précision et la rapidité au
          sabre font de lui un combattant de kenjutsu hors pair. Au fil de
          ses pérégrinations, Zatoïchi arrive dans un village sous la
          coupe d'un chef local, Ginzo, qui fait régner la terreur en se
          débarrassant de quiconque osera se dresser sur son chemin, par
          l'intermédiaire d'un redoutable rōnin, Hattori. Zatoïchi
          rencontre dans un bar deux geishas aussi belles que dangereuses,
          qui se rendent de ville en ville pour rechercher le meurtrier de
          leurs parents. Leur seul indice est un nom : « Kuchinawa ».
          Alors que les hommes de main de Ginzo découvrent Zatoïchi, le
          combat s'engage et la légendaire canne-épée de celui-ci entre en
          action.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/BL-A.jpg" alt="Quentin Tarantino" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">The Big Lebowski</h2>
        <p>
          Jeff Lebowski, prénommé le Duc, est un paresseux qui passe son
          temps à boire avec son copain Walter et à jouer au bowling, jeu
          dont il est fanatique. Un jour deux malfrats le passent à tabac.
          Il semblerait qu'un certain Jackie Treehorn veuille récupérer
          une somme d'argent que lui doit la femme de Jeff. Seulement
          Lebowski n'est pas marié. C'est une méprise, le Lebowski
          recherché est un millionnaire de Pasadena. Le Duc part alors en
          quête d'un dédommagement auprès de son richissime homonyme.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/evildeadtrilogy.jpg" alt="Quentin Tarantino" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Evil Dead trilogie</h2>
        <p>
          Cinq étudiants de l'université d'État du Michigan, Ash Williams,
          sa petite amie Linda, Cheryl, la sœur d'Ash, leur ami Scott et
          sa petite amie Shelly, partent passer des vacances dans une
          cabane perdue dans la forêt du Tennessee. Peu après leur
          arrivée, Cheryl fait un dessin lorsqu'elle entend une voix à
          l'extérieur de la cabane. Sa main devient alors comme possédée,
          ce qui l'amène à sculpter dans l'épaisseur de son bloc de dessin
          avec la mine de son crayon un livre avec un visage déformé et
          maléfique.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/Old_Boy.jpg" alt="Quentin Tarantino" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Old Boy</h2>
        <p>
          Alors qu'il s'apprêtait à fêter l'anniversaire de sa fille, Oh
          Dae-su est arrêté par la police pour ivresse sur la voie
          publique. Arrivé plus tard, son ami, Joo-hwan, persuade les
          policiers de le laisser repartir. Mais, sur le chemin du retour,
          Oh Dae-su est enlevé. Il est ensuite séquestré dans une pièce,
          sans savoir par qui ni pourquoi, avec pour seul lien avec
          l'extérieur une télévision, par laquelle il apprend que sa femme
          a été assassinée, qu'il est le principal suspect du meurtre et
          que sa fille a été confiée à des parents adoptifs. Oh Dae-su
          passe le temps en s'entraînant à boxer contre les murs et en
          essayant de creuser un tunnel pour s'échapper.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/pxvr4cdbosjtge7onp02kuzb5bg-849.jpg" alt="Quentin Tarantino" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Tueurs nés</h2>
        <p>
          Un jeune couple, Mickey (Woody Harrelson) et Mallory Knox
          (Juliette Lewis), décide de s’embarquer dans une virée
          sanglante. Eux qui ont été victimes de mauvais traitements de la
          part de leurs parents respectifs, tuent les gens qu’ils
          rencontrent sur leur route. Leur déchéance et leur errance
          sanglante à travers les États-Unis sont scrutées par les médias.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/suicide_kings.jpg" alt="Quentin Tarantino" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Suicide Kings</h2>
        <p>
          Quatre jeunes gens de bonne famille, Brett, Max, Avery et T. K.,
          mettent au point un plan pour enlever Charlie Barret, un ancien
          parrain de la mafia. Après avoir réussi tant bien que mal le
          kidnapping, ils l'emmènent chez un cinquième ami, David, qui
          n'était pas informé du projet de ses amis. Ils expliquent
          ensuite à Charlie (anciennement connu sous le nom de Carlo
          Bartolucci) qu'Elise, la sœur d'Avery et petite amie de Max, a
          été enlevée et qu'il est le seul à pouvoir verser la rançon de 2
          000 000 $ tout en ayant les moyens nécessaires pour la récupérer
          par la suite. De plus, pour lui prouver qu'ils ne plaisantent
          pas, ils lui montrent son petit doigt qu'ils lui ont coupé
          pendant qu'il était inconscient.
        </p>
      </article>
    </div>
  </div>
  <div class="accueil">
    <div class="img">
      <img src="../img/images-films/thumb_16750_360_480_0_0_auto.jpg" alt="Quentin Tarantino" />
    </div>
    <div class="d-flex align-items-center col-6">
      <article class="presentation1">
        <h2 class="syn">Monster</h2>
        <p>
          Aileen (Charlize Theron) zone depuis des années et survit en se
          prostituant. Un jour, elle rencontre dans un bar Selby
          (Christina Ricci), une jeune lesbienne un peu immature, dont
          elle tombe vite amoureuse. Les deux jeunes filles tentent alors
          d'échapper à leur quotidien : Selby veut s'évader d'une famille
          rigide et envahissante et Aileen souhaite trouver un travail.
          Pourtant, parce que la situation financière n'est pas facile,
          Aileen retourne se prostituer. Une nuit, elle se fait agresser
          par un client qu'elle parvient in extremis à tuer. Un premier
          crime. D'autres, alors, suivront.
        </p>
      </article>
    </div>
  </div>
</div>
<!-- Fin article de presentation -->
<?php
require_once("../elements/footer.php");
?>