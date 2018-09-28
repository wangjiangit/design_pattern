<?php

/**
 *一个抽象类公开定义了执行它的方法的方式/模板。它的子类可以按需要重写方法实现，但调用将以抽象类中定义的方式进*行。这种类型的设计模式属于行为型模式
 * (模板设计模式创建了一个实施一组方法和功能的抽象类，子类通常将这个抽象类作为模板用于自己的设计)
 */
abstract class Template
{
    public function method1()
    {
        echo 'abstract method1';
    }

    public function method2()
    {
        echo 'abstract method2';
    }

    public function method3()
    {
        echo 'abstract method3';
    }
}

class Template1 extends Template
{
    //重写模板method2逻辑
    public function method2()
    {
        echo 'Template1 method2';
    }
}

class Template2 extends Template
{

    //重写模板method1逻辑
    public function method1()
    {
        echo 'Template2 method1';
    }
}

//调用
$template1=new Template1();
$template2=new Template2();

$template1->method1();
$template1->method2();
$template1->method3();

$template2->method1();
$template2->method2();
$template2->method3();