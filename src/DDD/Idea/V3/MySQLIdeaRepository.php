<?php

namespace DDD\Idea\V3;

use DDD\Idea\Idea;

class MySQLIdeaRepository implements IdeaRepository
{
    private $client;

    public function __construct()
    {
        $this->client = new \Zend_Db_Adapter_Pdo_Mysql(
            array(
                'host'     => 'localhost',
                'username' => 'idy',
                'password' => '',
                'dbname'   => 'idy'
            )
        );
    }

    public function find($id)
    {
        $sql = 'SELECT * FROM ideas WHERE idea_id = ?';
        $row = $this->client->fetchRow($sql, $id);
        if (!$row) {
            return null;
        }
        $idea = new Idea();
        $idea->setId($row['id']);
        $idea->setTitle($row['title']);
        $idea->setDescription($row['description']);
        $idea->setRating($row['rating']);
        $idea->setVotes($row['votes']);
        $idea->setAuthor($row['email']);

        return $idea;
    }

    public function update(Idea $idea)
    {
        $data = array(
            'title'       => $idea->getTitle(),
            'description' => $idea->getDescription(),
            'rating'      => $idea->getRating(),
            'votes'       => $idea->getVotes(),
            'email'       => $idea->getAuthor(),
        );
        $where = array('idea_id = ?' => $idea->getId());
        $this->client->update('ideas', $data, $where);
    }
}