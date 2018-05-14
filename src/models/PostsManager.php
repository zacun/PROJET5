<?php
namespace niluap\src\models;

use niluap\core\Manager;

/**
 * Class PostsManager
 * @package niluap\src\models
 * Get/Set posts information
 */
class PostsManager extends Manager {

    public function getAllPosts() {
        $req = $this->query(
            'SELECT id, title, DATE_FORMAT(post_date, \'%d %M %Y\') AS date_fr
                        FROM posts 
                        ORDER BY post_date DESC 
                        ');
        return $req;
    }

    public function lastAddedPosts() {
        $req = $this->query(
            'SELECT id, title, content, DATE_FORMAT(post_date, \'%d %M %Y\') AS date_fr 
                        FROM posts
                        ORDER BY post_date DESC
                        LIMIT 0, 2
                        ');
        return $req;
    }

    public function getOnePost($postId) {
        $req = $this->prepare(
            'SELECT id, title, content, DATE_FORMAT(post_date, \'%d %M %Y à %Hh%i\') AS date_fr 
                        FROM posts
                        WHERE id = ?', [$postId], true, true
        );
        return $req;
    }

    public function newPost($title, $content) {
        $req = $this->prepare(
            'INSERT INTO posts(title, content, post_date)
                        VALUES (?, ?, NOW())', [$title, $content]
        );
        return $req;
    }

    public function editPost($postId, $title, $content) {
        $req = $this->prepare(
            'UPDATE posts 
                        SET title = ?, content = ? 
                        WHERE id = ?', [$title, $content, $postId]
        );
        return $req;
    }

    public function deletePost($postId) {
        $req = $this->prepare('DELETE FROM posts WHERE id = ?', [$postId]);
        return $req;
    }

}