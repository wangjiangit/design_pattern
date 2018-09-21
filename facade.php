<?php

/**
 * 外观者模式：在复杂的逻辑和方法的集合前创建简单的外观接口，外观设计模式隐藏了来自调用对象的复杂性,
 *为子系统中的一组接口提供一个一致的界面,定义一个高层接口,使得这一子系统更加的容易使用
 */
class SubSystem1
{

    public function method1()
    {
        echo 'subsystem1 method1';
    }
}

class SubSystem2
{

    public function method2()
    {
        echo 'subsystem2 method2';
    }
}

class SubSystem3
{

    public function method3()
    {
        echo 'subsystem3 method3';
    }
}


class SubSystemFacades
{

    private $_object1 = null;

    private $_object2 = null;

    private $_object3 = null;

    public function __construct()
    {
        $this->_object1 = new SubSystem1();
        $this->_object2 = new SubSystem2();
        $this->_object3 = new SubSystem3();
    }

    public function methodA()
    {
        $this->_object1->method1();
        $this->_object2->method2();
    }

    public function methodB()
    {
        $this->_object2->method2();
        $this->_object3->method3();
    }
}


//调用，对外统一输出methodA和methodB

$subSystemFacade = new SubSystemFacades();
$subSystemFacade->methodA();
$subSystemFacade->methodB();