<?php

namespace Profiler;

class ArrayProfiler extends Profiler
{
    protected $classes = array(
        '\Functional\ArrayForEach',
        '\Functional\ArrayMap',
    );
    /** @var array */
    protected $numberOfFields = array(10, 25, 50, 100, 50000);
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
     * @param array  $data
     */
    public function profileExecute($class, $data)
    {
        $instance = new $class($data);
        $average = 0;
        for ($i = 0; $i < 10; $i++) {
            $start = microtime(true);
            /** @var \Functional\ArrayForEach $instance */
            $instance->execute();
            $average = ($average + microtime(true) - $start) / 2;
        }
        $this->addMessage($class, __METHOD__ . '(' . $data . ')', $average);
    }
}