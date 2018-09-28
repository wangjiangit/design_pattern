<?php

/**
 *表示数据结构的类只需要提供对"访问者"开放的接口(API)，而对元素的处理则由访问者负责，当需要新增一种对元素的处理方式时，只需要编写新的表示访问者*的类即可，这样就无需对表示数据结构的类(原有的代码)进行修改，又扩展出了新功能。
 */
class CD
{
    public $band;

    public $title;

    public $price;

    public $count;

    public function __construct($band, $title, $price, $count)
    {
        $this->band = $band;
        $this->title = $title;
        $this->price = $price;
        $this->count = $count;
    }


    public function buy()
    {
        echo 'buy...';
    }

    //对外开发的API
    public function acceptVisitor($visitor)
    {
        $visitor->visitCD($this);
    }
}

//对元素的处理逻辑以下列访问者的形式存在，做到了面向对象“闭关原则”

//日志记录访问者类
class CDVisitorLogPurchase
{
    public function visitCD(CD $cd)
    {
        $logline = "{$cd->title} by {$cd->band}  was purchase for {$cd->price} at " . date('Y-m-d') . "\n";
        file_put_contents('purchase.log', $logline, FILE_APPEND);
    }

}

//实时显示CD数量访问者类
class CDVisitorRealtimeShow
{
    public function visitCD(CD $cd)
    {
        echo '商品数量：' . $cd->count;
    }
}


//调用
$externalBand = 'Never Again';
$externalTitle = 'Waste of a Rib';
$externalPrice = '9.99';

$cd = new CD($externalBand, $externalTitle, $externalPrice, 5);
$cd->buy();
$cd->acceptVisitor(new CDVisitorLogPurchase());
$cd->acceptVisitor(new CDVisitorRealtimeShow());

