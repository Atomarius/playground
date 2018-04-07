<?php

namespace Functional;

class ArrayMap
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
        $this->array = array_map(function ($v) { $v['id'] = rand(1,10); return $v; }, $this->array);
    }
}