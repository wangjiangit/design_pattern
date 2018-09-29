<?php

class Base
{
    /**
     * 魔术方法
     * @param string $name
     * @param string $value
     * @return void
     */
    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }
}