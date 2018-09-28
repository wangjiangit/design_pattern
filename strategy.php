<?php

/**
 * 策略设计模式构建的对象不必自身包含逻辑，而是能够根据需要利用其它对象中的算法
 * 使用场景比如：
 * 比如说购物车系统，在给商品计算总价的时候，普通会员肯定是商品单价乘以数量，但是对中级会员提供8折折扣，对高级会员提供7折折扣
 */
interface ComputePrice
{
    public function computePrice($price);
}

class GeneralMember implements ComputePrice
{
    public function computePrice($price)
    {
        return $price;
    }
}

class MiddleMember implements ComputePrice
{
    public function computePrice($price)
    {
        return $price * 0.8;
    }
}

class HighMember implements ComputePrice
{
    public function computePrice($price)
    {
        return $price * 0.7;
    }
}


class PriceStrategy
{
    protected $strategy;

    public function __construct($stragegy)
    {
        $this->strategy = $stragegy;
    }

    public function computePrice($price)
    {
        $this->strategy->computePrice($price);
    }
}

//调用
$price = new PriceStrategy(new GeneralMember());
echo $price->computePrice(10);

$price = new PriceStrategy(new MiddleMember());
echo $price->computePrice(10);

$price = new PriceStrategy(new HighMember());
echo $price->computePrice(10);




