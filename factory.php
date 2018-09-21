<?php

/**
 * 工厂设计模式提供获取某个对象的新实例的一个接口，同时使调用代码避免确定实际实例化基类的步骤。
 *优点：创建对象上面，就是把创建对象的过程封装起来，这样随时可以产生一个新的对象
 */
class CD
{

    public $title = '';

    public $band = '';

    public $tracks = array();

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setBand($band)
    {
        $this->band = $band;
    }

    public function addTrack($track)
    {
        $this->tracks[] = $track;
    }


    public function getTracks()
    {

        foreach ($this->tracks as $v) {
            echo $v . "<br/>";
        }

    }


}


$title = 'MUSIC A';
$band = 'Music is A band';
$tracksFromExternalSource = array('I love you', 'DANCE OF CHINA');
$cd = new CD();
$cd->setTitle($title);
$cd->setBand($band);

foreach ($tracksFromExternalSource as $v) {
    $cd->addTrack($v);
}


//增强CD类，通过标签 DATA TRACK控制CD数据

class EnhancedCD
{

    public $title = '';

    public $band = '';

    public $tracks = array();

    public function __construct()
    {

        $this->tracks[] = 'DATA TRACK';
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setBand($band)
    {
        $this->band = $band;
    }

    public function addTrack($track)
    {
        $this->tracks[] = $track;
    }


    public function getTracks()
    {

        foreach ($this->tracks as $v) {
            echo $v . "<br/>";
        }

    }

}

//工厂类

class CDFactory
{
    public static function create($type)
    {
        $class=strtolower($type).'CD';
        return new $class;
    }
}

$tracksFromExternalSource=array( 'MUSIC A','music b','MUSIC C');
$cdEnHanced=CDFactory::create('Enhanced' );

foreach ($tracksFromExternalSource as $v){
    $cdEnHanced->addTrack($v);
}

$cdEnHanced->getTracks();
