<?php
namespace DDD\Profiler;

use DDD\Currency;
use DDD\Money;

class MoneyProfiler
{
    protected $classes = array(
        '\DDD\MoneyDirectAccess\Money',
        '\DDD\MoneyPublicMethod\Money',
    );

    private $messages = array();

    private $currency;

    private $cycles;

    public function __construct($cycles) {
        $this->currency = new Currency('EUR');
        $this->cycles = $cycles;
    }

    public function profile()
    {
        $this->profileConstruct();
        $this->profileEquals();
        $this->profileAdd();
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
            $this->messages[] = sprintf("%s::$class- $average",  __METHOD__);
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
            $this->messages[] = sprintf("%s::$class- $average",  __METHOD__);
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
            $this->messages[] = sprintf("%s::$class- $average",  __METHOD__);
        }
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
}