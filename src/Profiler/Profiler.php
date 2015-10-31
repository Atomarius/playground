<?php

namespace Profiler;

abstract class Profiler
{
    /** @var int */
    protected $cycles;
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
        echo PHP_EOL . sprintf("%s - $average", str_replace(get_class($this), $class, $method));
        // $this->messages[] = sprintf("%s - $average", str_replace(get_class($this), $class, $method));
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
}