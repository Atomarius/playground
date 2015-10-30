<?php

namespace DDD\Profiler;

class ValueObjectProfiler extends Profiler
{
    protected $classes = array(
        '\DDD\ValueObject\ArrayAccess',
        '\DDD\ValueObject\ArrayKeys',
    );

    /** @var array */
    private $numberOfFields = array(10, 100, 1000);

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
                    $data = array();
                    for ($i = 0; $i < $fields; $i++) {
                        $data[$i] = $i;
                    }
                    foreach ($this->classes as $class) {
                        $this->$method($class, $data);
                    }
                }
            }
        }
    }

    /**
     * @param string $class
     * @param array  $data
     */
    public function profileExchangeArray($class, $data)
    {
        $instance = new $class($data);
        $average = 0;
        for ($i = 0; $i < $this->cycles; $i++) {
            $start = microtime(true);
            /** @var \DDD\ValueObject\ArrayAccess $instance */
            $instance->exchangeArray(array());
            $average = ($average + microtime(true) - $start) / 2;
        }
        $this->addMessage($class, __METHOD__ . '(' . count($data) . ')', $average);
    }
}
