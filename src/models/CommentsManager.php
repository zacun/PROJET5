<?php
namespace niluap\src\models;

use niluap\core\Manager;

/**
 * Class CommentsManager
 * @package niluap\src\models
 * Get/set comments information
 */
class CommentsManager extends Manager {

    public function getCommentsByPost($postId) {
        $req = $this->prepare(
            'SELECT id, author, content, post_id, allowed, DATE_FORMAT(comment_date, \'%d %M %Y à %Hh%i\') AS date_fr
                        FROM comments
                        WHERE post_id = ? 
                        AND allowed = 1
                        ORDER BY comment_date DESC',
            array($postId), true
        );
        return $req;
    }
}