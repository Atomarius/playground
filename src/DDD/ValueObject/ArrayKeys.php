<?php

namespace DDD\ValueObject;

class ArrayKeys extends ArrayAccess
{
    public function exchangeArray(array $data)
    {
        foreach (array_keys($this->data) as $key) {
            if (array_key_exists($key, $data)) {
                $this->data[$key] = $data[$key];
            }
        }

        return $this;
    }
}
