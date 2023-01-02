<?php

namespace Neon\Config;

use OutOfBoundsException;
use ReturnTypeWillChange;

class Config implements \ArrayAccess
{
    /**
     * @param array $data
     */
    public function __construct( private array $data=[] ) {}

    /**
     * @param $offset
     * @param $value
     * @return void
     */
    #[ReturnTypeWillChange] public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * @param $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param $offset
     * @return void
     */
    #[ReturnTypeWillChange] public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }

    /**
     * @param $offset
     * @return mixed|null
     */
    #[ReturnTypeWillChange] public function offsetGet($offset) {
        return $this->data[$offset] ?? null;
    }

    /**
     * @return array|null
     */
    public function __debugInfo(): ?array
    {
        return $this->data;
    }
}