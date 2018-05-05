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
            'SELECT id, author, content, post_id, reported, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS date_fr
                        FROM comments
                        WHERE post_id = ?
                        ORDER BY comment_date DESC',
            array($postId), true
        );
        return $req;
    }
}