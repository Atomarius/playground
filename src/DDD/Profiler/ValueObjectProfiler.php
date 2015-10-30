<?php

namespace DDD\Profiler;

class ValueObjectProfiler extends Profiler
{
    protected $classes = array(
        '\DDD\ValueObject\ArrayAccess',
        '\DDD\ValueObject\ArrayKeys',
    );

    /** @var array */
    private $numberOfFields = array(10, 100, 1000, 10000);

    /**
     * @param int $cycles
     */
    public function __construct($cycles)
    {
        $this->cycles = $cycles;
    }

    public function execute()
    {
        foreach (get_class_methods(get_class($this)) as $method) {
            if (strpos($method, 'profile') === 0) {
                foreach ($this->numberOfFields as $fields) {
                    foreach ($this->classes as $class) {
                        $this->$method($class, $fields);
                    }
                }
            }
        }
    }

    /**
     * @param string $class
     * @param int    $fields
     */
    public function profileExchangeArray($class, $fields)
    {
        $fixture = new $class($fields);
        $average = 0;
        for ($i = 0; $i < $this->cycles; $i++) {
            $start = microtime(true);
            /** @var \DDD\ValueObject\ArrayAccess $instance */
            $average = ($average + microtime(true) - $start) / 2;
        }
        $this->addMessage($class, __METHOD__ . "({$fields})", $average);
    }
}
