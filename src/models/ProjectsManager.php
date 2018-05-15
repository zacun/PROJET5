<?php
namespace niluap\src\models;

use niluap\core\Manager;

/**
 * Class ProjectsManager
 * @package niluap\src\models
 * Get/Set project information
 */
class ProjectsManager extends Manager {

    public function getAllProjects() {
        $req = $this->query(
            'SELECT *
                        FROM projects 
                        ORDER BY id DESC 
                        ');
        return $req;
    }

    public function lastAddedProjects() {
        $req = $this->query(
            'SELECT *
                        FROM projects
                        ORDER BY id DESC
                        LIMIT 0, 2
                        ');
        return $req;
    }

    public function getOneProject($id) {
        $req = $this->prepare('SELECT * FROM projects WHERE id = ?', [$id], true, true);
        return $req;
    }

    public function newProject($name, $description, $path, $image_path) {
        $req = $this->prepare(
            'INSERT INTO projects(name, description, path, image_path)
                        VALUES (?, ?, ?, ?)', [$name, $description, $path, $image_path]);
        return $req;
    }

    public function editProject($projectId, $name, $description, $path, $image_path) {
        $req = $this->prepare(
            'UPDATE projects 
                        SET name = ?, description = ?, path = ?, image_path = ? 
                        WHERE id = ?', [$name, $description, $path, $image_path, $projectId]
        );
        return $req;
    }

    public function deleteProject($projectId) {
        $req = $this->prepare('DELETE FROM projects WHERE id = ?', [$projectId]);
        return $req;
    }

}