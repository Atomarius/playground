<?php
namespace DDD\ValueObject;

class ArrayAccess
{
    protected $data = array();

    /**
     * @param int $numberOfFields
     */
    public function __construct($numberOfFields)
    {
        for ($i = 0; $i < $numberOfFields; $i++) {
            $data[$i] = $i;
        }
    }

    /**
     * @see http://php.net/manual/de/arrayobject.getarraycopy.php
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function exchangeArray(array $data)
    {
        foreach ($this->data as $key => $value) {
            if (array_key_exists($key, $data)) {
                $this->data[$key] = $data[$key];
            }
        }

        return $this;
    }
}
