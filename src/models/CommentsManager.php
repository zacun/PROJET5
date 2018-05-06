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

    public function postComment($postId, $author, $content) {
        $req = $this->prepare(
            'INSERT INTO comments(post_id, author, content, comment_date)
                        VALUES (?, ?, ?, NOW())', array($postId, $author, $content)
        );
    }

    public function getNewComments () {
        /* Avenir */
    }

    public function acceptComment($commentId) {
        $req = $this->prepare(
            'UPDATE comments
                        SET allowed = 1
                        WHERE id = ?', array($commentId)
        );
    }

    public function deleteComment($commentId) {
        $req = $this->prepare(
            'DELETE FROM comments WHERE id = ?',
            array($commentId)
        );
    }

}