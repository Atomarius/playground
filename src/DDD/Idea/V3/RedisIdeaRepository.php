<?php

namespace DDD\Idea\V3;

use DDD\Idea\Idea;

class RedisIdeaRepository implements IdeaRepository
{
    /** @var \Predis\Client */
    private $client;

    public function __construct()
    {
        $this->client = new \Predis\Client();
    }

    public function find($id)
    {
        $idea = $this->client->get($this->getKey($id));
        if (!$idea) {
            return null;
        }
        return unserialize($idea);
    }

    public function update(Idea $idea)
    {
        $this->client->set(
            $this->getKey($idea->getId()),
            serialize($idea)
        );
    }

    private function getKey($id)
    {
        return 'idea:' . $id;
    }
}