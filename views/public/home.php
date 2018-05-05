<?php

use niluap\core\Controller;
use niluap\core\Router;

$title = 'Accueil';
?>
<section class="home">
    <h2>Derniers Projets</h2>
    <div class="last-projects">
        <?php foreach ($lastAddedProjects as $lastProject): ?>
            <figure class="portfolio-item">
                <a href="<?= $lastProject['path'] ?>"><img src="<?= $lastProject['image_path'] ?>" alt="<?= $lastProject['name'] ?>" /></a>
                <figcaption>
                    <p>
                        <?= $lastProject['name'] ?><br /><?= $lastProject['description'] ?>
                    </p>
                </figcaption>
            </figure>
        <?php endforeach ?>
    </div>
</section>
<section class="home">
    <h2>Derniers Articles</h2>
    <div class="last-posts">
        <?php foreach ($lastAddedPosts as $lastPost): ?>
            <article>
                <h1><?= $lastPost['title']; ?></h1>
                <div>
                    <?= Controller::getExcerpt($lastPost['content'], 150); ?>
                    <a href="<?= Router::getUrl('blog-post') . '?id=' . $lastPost['id'] ?>">-> Lire la suite</a>
                </div>
                <small>Publié le <?= $lastPost['date_fr'] ?></small>
            </article>
        <?php endforeach ?>
    </div>
</section>
<section class="home terminal-readme">
    <h2>Terminal de navigation : utilisation</h2>
    <p>A venir !</p>
</section>
<section class="home">
    <h2>Contact</h2>
    <p>
        Vous souhaitez me contacter ?<br>
        Utilisez le formulaire de contact ou bien directement via l'adresse mail suivante :<br>
        <em>batpaulin@gmail.com</em>
    </p>
    <div class="contact">
        <p class="contact-show"><span class="contact-show-message">+ Afficher</span> le formulaire de contact</p>
        <form class="contact-form off">
            <input type="text" title="contact-name" id="contact-name" name="contact-name" placeholder="Votre nom..." required>
            <input type="email" title="contact-mail" id="contact-mail" name="contact-mail" placeholder="Votre mail..." required><br>
            <input type="text" title="contact-subject" id="contact-subject" name="contact-subject" placeholder="Sujet..." required><br>
            <textarea title="contact-message" id="contact-message" name="contact-message" placeholder="Votre message..." cols="80" rows="20" required></textarea><br>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</section>

<script src="../../public/js/contact.js"></script>