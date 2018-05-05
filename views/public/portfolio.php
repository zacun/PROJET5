<?php
use niluap\core\Router;
$title = 'Portfolio';
?>
<section class="portfolio">
    <h2>Liste des projets</h2>
    <p>Les projets sont classés des plus récents aux plus anciens</p>
    <div class="portfolio-container">
        <?php foreach ($allProjects as $project): ?>
            <figure class="portfolio-item">
                <a href="<?= $project['path'] ?>"><img src="<?= $project['image_path'] ?>" alt="<?= $project['name'] ?>" /></a>
                <figcaption>
                    <p><?= $project['name'] ?><br /> <?= $project['description'] ?></p>
                </figcaption>
            </figure>
        <?php endforeach ?>
    </div>
</section>