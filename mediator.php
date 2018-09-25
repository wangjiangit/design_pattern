<?php

/**
 * 定义一个中介对象来封装系列对象之间的交互。
 * 中介者使各个对象不需要显示地相互引用，从而使其耦合性松散，而且可以独立改变他们之间的交互
 */
abstract class Student
{
    public $content;

    public function setContent($content)
    {

        $this->content = $content;

    }

    public function getContent()
    {
        return $this->content;
    }

    abstract public function talk();

}


class StudentA extends Student
{

    public function talk()
    {
        // TODO: Implement talk() method.
        echo '同学A说:' . $this->getContent();
    }

}

class StudentB extends Student
{
    public function talk()
    {
        // TODO: Implement talk() method.
        echo '同学B说:' . $this->getContent();
    }

}

class StudentC extends Student
{
    public function talk()
    {
        // TODO: Implement talk() method.
        echo '同学C说:' . $this->getContent();
    }
}


class Mediator
{
    public $studentList = [];

    public function addStudent(Student $student)
    {
        $this->studentList[] = $student;
    }

    public function notify(Student $student)
    {

        $student->talk();

        foreach ($this->studentList as $k => $v) {

            if ($student != $this->studentList[$k]) {
                $this->studentList[$k]->talk();
            }
        }

    }
}


//调用
$studentA = new StudentA();
$studentB = new StudentB();
$studentC = new StudentC();

$studentA->setContent('A收到了!');
$studentB->setContent('B收到了!');
$studentC->setContent('今天下午开会,17:00二楼会议室');

$mediator = new Mediator();
$mediator->addStudent($studentA);
$mediator->addStudent($studentB);
$mediator->addStudent($studentC);

$mediator->notify($studentC); //studentC 发出通知，其余 student 做出相应应答
