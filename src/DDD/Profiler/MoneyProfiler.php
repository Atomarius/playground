<?php
namespace DDD\Profiler;

use DDD\Currency;
use DDD\Money;

class MoneyProfiler extends Profiler
{
    protected $classes = array(
        '\DDD\MoneyDirectAccess\Money',
        '\DDD\MoneyAccessMethod\Money',
    );

    private $messages = array();

    private $currency;

    private $cycles;

    public function __construct($cycles)
    {
        $this->cycles = $cycles;
        $this->currency = new Currency('EUR');
    }

    public function execute()
    {
        foreach (get_class_methods(__CLASS__) as $method) {
            if (strpos($method, 'profile') === 0) {
                $this->$method();
            }
        }
    }

    protected function profileConstruct()
    {
        foreach($this->classes as $class) {
            $average = 0;
            for($i = 0; $i < $this->cycles; $i++) {
                $start = microtime(true);
                /** @var Money $instance */
                $instance = new $class(100, $this->currency);
                $average = ($average + microtime(true) - $start) / 2;
            }
            $this->addMessage($class, __METHOD__, $average);
        }
    }

    protected function profileAdd()
    {
        foreach($this->classes as $class) {
            /** @var Money $instance */
            $instance = new $class(100, $this->currency);
            $average = 0;
            for($i = 0; $i < $this->cycles; $i++) {
                $start = microtime(true);
                $instance->add($instance);
                $average = ($average + microtime(true) - $start) / 2;
            }
            $this->addMessage($class, __METHOD__, $average);
        }
    }

    protected function profileEquals()
    {
        foreach($this->classes as $class) {
            /** @var Money $instance */
            $instance = new $class(100, $this->currency);
            $average = 0;
            for($i = 0; $i < $this->cycles; $i++) {
                $start = microtime(true);
                $instance->equals($instance);
                $average = ($average + microtime(true) - $start) / 2;
            }
            $this->addMessage($class, __METHOD__, $average);
        }
    }

    protected function profileConverTo()
    {
        $currency = new Currency('USD');
        foreach($this->classes as $class) {
            /** @var Money $instance */
            $instance = new $class(100, $this->currency);
            $average = 0;
            for($i = 0; $i < $this->cycles; $i++) {
                $start = microtime(true);
                $instance->convertTo(1.8, $currency);
                $average = ($average + microtime(true) - $start) / 2;
            }
            $this->addMessage($class, __METHOD__, $average);
        }
    }
}