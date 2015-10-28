<?php

namespace DDD\Profiler;

abstract class Profiler
{
    /** @var array  */
    private $messages = array();

    abstract public function execute();

    /**
     * @param string $class
     * @param string $method
     * @param float $average
     */
    protected function addMessage($class, $method, $average)
    {
        $this->messages[] = sprintf("%s - $average", str_replace(get_class($this), $class, $method));
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
}