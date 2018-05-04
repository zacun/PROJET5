<!DOCTYPE html>
<html lang="fr_FR">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="icon" type="image/png" href="../../public/images/favicon/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Play|Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Niluap - <?= $title; ?></title>
</head>

<body>
<div class="site">
    <nav class="site-menu">
        <a href="#">Accueil</a>
        <a href="#">Blog</a>
        <a href="#">Portfolio</a>
        <a href="#">C.V</a>
    </nav>
    <div class="site-content">
        <header class="site-header">
            <h1 class="site-header__title">Bat Paulin</h1>
            <p class="site-header__description">
                <a href="https://openclassrooms.com/paths/developpeur-web-junior" target="_blank" data-tooltip='Lien vers la formation suivie'>
                    Développeur Web Junior<br />OpenClassrooms
                </a>
            </p>
            <div class="site-header__progressBar">
                <p>
                    Progression de la formation à 80%.<br>Obtention du diplôme estimée pour fin Mai 2018.
                </p>
                <div class="progressBar__container">
                    <div class="progressBar__content"></div>
                </div>
            </div>
        </header>
        <main class="site-main">
            <?= $content; ?>
        </main>
        <footer class="site-footer">
            <div>&copy; 2018 - Bat Paulin - All Rights Reserved</div>
        </footer>
    </div>
</div>
<!-- Terminal window -->
<div id="terminal">
    <form class="terminal-form">
        <div class="terminal-screen">
            <p>Ceci est un terminal de navigation.</p>
            <p>Il permet une navigation avancée sur le site.</p>
            <p>Pour voir les commandes à votre disposition, tapez : -help</p>
        </div>
        <div class="terminal-inputs">
            <input type="text" class="terminal-input" id="terminal-input" name="terminal-input" placeholder="Entrez une commande...">
            <button class="terminal-submit">Valider</button>
        </div>
    </form>
</div>
<div class="terminal-button" data-tooltip="Ouvrir le terminal">
    <i class="fas fa-window-maximize fa-5x"></i>
</div>
<!-- End of terminal window -->
</body>

</html>