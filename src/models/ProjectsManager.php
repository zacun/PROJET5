<?php
namespace niluap\src\models;

use niluap\core\Manager;

/**
 * Class ProjectsManager
 * @package niluap\src\models
 * Get/Set project information
 */
class ProjectsManager extends Manager {

    public function lastAddedProjects() {
        $req = $this->query(
            'SELECT *
                        FROM projects
                        ORDER BY id DESC
                        LIMIT 0, 2
                        ');
        return $req;
    }

}