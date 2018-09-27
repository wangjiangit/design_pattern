<?php

/**
 * 代理设计模式构建了透明置于两个不同对象之内的一个对象，从而能够截取或代理这两个对象间的通信或访问
 * (代理对象内部含有目标对象的引用，从而可以在任何时候操作目标对象；代理对象提供一个与目标对象相同的接口，以便可以在任何时候替代目标对象。代理对象 * 通常在客户端调用传递给目标对象之前或之后，执行某个操作，而不是单纯地将调用传递给目标对象。)
 */
interface Vendor
{
    public function displayBrand();

    public function displayProductCount();

}


class Lenovo implements Vendor
{
    public $count = 0;

    public function __construct($count)
    {
        $this->count = $count;
    }

    public function displayBrand()
    {
        // TODO: Implement procedure() method.
        return '联想品牌';
    }

    public function displayProductCount()
    {
        // TODO: Implement displayProductCount() method.
        echo '剩余电脑数量：' . $this->count;
    }
}

interface Proxy
{
    public function queryProductCount();

    public function queryBrand();

    public function sell();
}


//小卖部
class Canteen implements Proxy
{
    protected $vendor = null;

    public function __construct()
    {
        $this->vendor = new Lenovo(5);
    }

    public function queryBrand()
    {
        // TODO: Implement queryBrand() method.
        echo '所属' . $this->vendor->displayBrand();
    }

    public function queryProductCount()
    {
        // TODO: Implement queryProductCount() method.
        echo $this->vendor->displayProductCount();
    }

    public function sell()
    {
        // TODO: Implement sell() method.
        $count = $this->vendor->count;
        if ($count <= 0) {
            echo '对不起，无货了!';
        } else {
            echo '亲，有货哦，请稍等!';
        }
    }

}


$canteen = new Canteen();
$canteen->queryBrand();  //客户通过代理对象$canteen查询厂家品牌
$canteen->queryProductCount();//客户通过代理对象$canteen查询厂家货物数量
$canteen->sell();//客户先代理商买货，代理商先查询厂家是否有货，再决定销售


