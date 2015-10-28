<?php

namespace DDD\Profiler;

abstract class Profiler
{
    /** @var array  */
    private $messages = array();

    abstract public function execute();

    protected function addMessage($class, $method, $average)
    {
        $this->messages[] = sprintf("%s - $average", str_replace(__CLASS__, $class, $method));
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
}