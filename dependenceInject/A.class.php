<?php

class A extends Base{

    private $instanceB;

    public function __construct(B $instanceB)
    {
        $this->instanceB = $instanceB;
    }

    public function test()
    {
        $this->instanceB->test();
    }
}