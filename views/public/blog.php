<?php
use niluap\core\Router;
$title = 'Blog';
?>
<section class="blog">
    <h2>Liste des articles</h2>
    <p>Les articles sont classés des plus récents aux plus anciens</p>
    <input type="search" title="searchbar" name="searchbar" id="searchbar" placeholder="Rechercher...">
    <div class="blog-posts-container">
        <?php foreach ($allPosts as $post): ?>
            <article class="blog-post">
                <h1 class="blog-post-title"><?= $post['title']; ?></h1>
                <div class="blog-post-info">
                    <span>Publié le <?= $post['date_fr']; ?></span>
                    <a href="<?= Router::getUrl('blog-post') . '?id=' . $post['id'] ?>">-> Lire l'article</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>