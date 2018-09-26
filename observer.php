<?php

/**
 * 通俗定义：
 * 该模式定义对象的一对多依赖，这样依赖，当一个对象改变状态时，它的所有依赖者都会收到通知并自动更新
 * (先定义一个被观察者的接口，这个接口要实现注册观察者，删除观察者和通知的功能)
 *
 * 标准定义：观察者模式（Observer）完美的将观察者和被观察的对象分离开。举个例子，用户界面可以作为一个观察者，业务 数据是被观察者，用户界面观察业 * 务数据的变化，发现数据变化后，就显示在界面上。面向对象设计的一个原则是：系统中的每个类将重点放在某一个功能上，而不 是其他方面。一个对象只做一件* 事情，并且将他做好。观察者模式在模块之间划定了清晰的界限，提高了应用程序的可维护性和重用性。
 * 观察者设计模式定义了对象间的一种一对多的依赖关系，以便一个对象的状态发生变化时，所有依赖于它的对象都得到通知并自动刷新。
 */
interface Observables
{

    public function attach(Observer $observer);

    public function detach(Observer $observer);

    public function notify(Observer $observer);

}

class Saler implements Observables
{

    public $obs = [];

    protected $range = 0;

    public function attach(Observer $observer)
    {
        // TODO: Implement attach() method.
        $this->obs[] = $observer;
    }

    public function detach(Observer $observer)
    {
        // TODO: Implement detach() method.
        foreach ($this->obs as $key => $ob) {

            if ($ob === $observer) {
                unset($this->obs[$key]);
            }

        }
    }


    public function notify(Observer $observer)
    {
        // TODO: Implement notify() method.
        foreach ($this->obs as $ob) {
            $ob->doActor($this);
        }
    }

    public function increPrice($range)
    {
        $this->range = $range;
    }

    public function getAddRange()
    {
        return $this->range;
    }
}


//定义一个观察者接口,这个接口要有一个在被通知的时候要实现的方法

interface Observer
{
    public function doActor(Observables $observables);
}

abstract class Buyer implements Observer
{

}


class PoorBuyer extends Buyer
{


    public function doActor(Observables $obv)
    {
        // TODO: Implement doActor() method.
        if ($obv->getAddRange() > 10) {

            echo '不买了，太吓人了<br/>';
        } else {
            echo '还行,买一点吧.<br/>';
        }
    }
}


class RichBuyer extends Buyer
{

    public function doActor(Observables $obv)
    {
        // TODO: Implement doActor() method.

        echo '你再涨价我也不怕，我穷的只剩钱<br/>';
    }

}


$poorBuyer = new PoorBuyer();
$richBuyer = new RichBuyer();

$saler = new Saler(); //小贩
$saler->attach($poorBuyer); //土鳖
$saler->attach($richBuyer);//土豪
$saler->notify();  //通知价格

//小贩要上涨价格,通知各位
$saler->increPrice(20);//价格上涨20元
$saler->notify(); //价格上涨后，再通知
