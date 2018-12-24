<?php

namespace Game;

class Scene
{
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var array */
    private $actions = [];

    /**
     * @param string $name
     * @param string $description
     */
    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function on($action)
    {
        return $this->actions[$action] ?? $this->actions['*'];
    }
}
