<?php

namespace Functional;

class ArrayForEach
{
    private $array = [];
    /**
     * @param int $num
     */
    public function __construct($num)
    {
        $this->array = array_fill(0, $num, ['id' => 0]);
    }

    public function execute()
    {
        foreach ($this->array as $k => $v) {
            $this->array[$k]['id'] = rand(1,10);
        }
    }
}