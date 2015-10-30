<?php
namespace DDD\ValueObject;

class ArrayAccess
{
    protected $data = array();

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->data = $data;
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
