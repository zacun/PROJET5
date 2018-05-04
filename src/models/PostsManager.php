<?php
namespace niluap\src\models;

use niluap\core\Manager;

/**
 * Class PostsManager
 * @package niluap\src\models
 * Get/Set posts information
 */
class PostsManager extends Manager {

    public function lastAddedPosts() {
        $req = $this->query(
            'SELECT id, title, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin\') AS date_fr 
                        FROM posts
                        ORDER BY post_date DESC
                        LIMIT 0, 2
                        ');
        return $req;
    }

}