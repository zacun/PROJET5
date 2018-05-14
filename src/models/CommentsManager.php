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
                        ORDER BY comment_date DESC', [$postId], true
        );
        return $req;
    }

    public function postComment($postId, $author, $content) {
        $req = $this->prepare(
            'INSERT INTO comments(post_id, author, content, comment_date)
                        VALUES (?, ?, ?, NOW())', [$postId, $author, $content]
        );
    }

    public function getAllComments () {
        $req = $this->query(
            'SELECT comments.id, comments.author, comments.content, comments.allowed, 
                        DATE_FORMAT(comment_date, \'%d %M %Y à %Hh%i\') AS date_fr,
                        posts.id AS linked_post,
                        posts.title AS linked_post_title
                        FROM comments
                        LEFT JOIN posts
                        ON comments.post_id = posts.id
                        WHERE comments.allowed = 1
                        ORDER BY comment_date DESC'
        );
        return $req;
    }

    /**
     * @return \PDOStatement
     */
    public function getNewComments () {
        $req = $this->query(
            'SELECT comments.id, comments.author, comments.content, comments.allowed, 
                        DATE_FORMAT(comment_date, \'%d %M %Y à %Hh%i\') AS date_fr,
                        posts.id AS linked_post,
                        posts.title AS linked_post_title
                        FROM comments
                        LEFT JOIN posts
                        ON comments.post_id = posts.id
                        WHERE comments.allowed = 0
                        ORDER BY comment_date'
        );
        return $req;
    }

    public function countNewComments () {
        $req = $this->query('SELECT allowed FROM comments WHERE allowed = 0');
        $count = $req->rowCount();
        return $count;
    }

    public function acceptComment($commentId) {
        $req = $this->prepare(
            'UPDATE comments
                        SET allowed = 1
                        WHERE id = ?', [$commentId]
        );
        return $req;
    }

    public function deleteComment($commentId) {
        $req = $this->prepare(
            'DELETE FROM comments WHERE id = ?', [$commentId]
        );
        return $req;
    }

}