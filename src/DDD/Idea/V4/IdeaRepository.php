<?php

namespace DDD\Idea\V4;

use DDD\Idea\Idea;

interface IdeaRepository
{
    /**
     * @param $id
     *
     * @return Idea
     */
    public function find($id);

    /**
     * @param Idea $idea
     *
     * @return Idea
     */
    public function update(Idea $idea);
}