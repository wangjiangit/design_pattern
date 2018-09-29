<?php

class B  extends Base{
    private $instanceC;

    public function __construct(C $instanceC)
    {
        $this->instanceC = $instanceC;
    }

    public function test()
    {
        return $this->instanceC->test();
    }
}