<?php

/**
 * 原型模式是一个创建型的模式。原型二字表明了改模式应该有一个样板实例，用户从这个样板对象中复制一个内部属性一致的对象，这个过程也就是我们称的“克隆”。被复制的实例就是我们所称的“原型”，这个原型是可定制的。原型模式多用于创建复杂的或者构造耗时的实例，因为这种情况下，复制一个已经存在的实例可使程序运行更高效。
 */
interface Prototype
{
    public function copy();
}

class Student implements Prototype
{

    public $school;

    public $major;

    public $name;

    public $age;

    public $height;

    public $foreignLanguageLevel;

    public function __construct($school, $major, $name, $age, $height, $foreignLanguageLevel)
    {
        $this->school = $school;
        $this->major = $major;
        $this->name = $name;
        $this->age = $age;
        $this->height = $height;
        $this->foreignLanguageLevel = $foreignLanguageLevel;
    }


    public function showProfile()
    {
        printf("学校：%s,主修科目：%s,姓名:%s,年龄：%u,身高：%.2f米,英语水平：%u级", $this->school, $this->major, $this->name, $this->age, $this->height, $this->foreignLanguageLevel);
    }


    public function copy()
    {
        // TODO: Implement copy() method.
        return clone $this;
    }
}

$student = new Student('家里蹲', '扫地', '王二麻子', 25, 1.75, 4);
$student->showProfile();

//这是需要创建类似对象，这对象创建需要初始化太多资源，就要用到原型设计模式
$studentA = $student->copy();
$studentA->name = '张三';
$studentA->showProfile();