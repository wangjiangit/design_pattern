<?php

/**
 * 装饰器模式如果已有对象的部分功能或内容发生改变，但是不需要修改原始对象的结构，那么使用装饰器设计模式最合适
 */
class CD
{

    public $trackList;

    public function __construct()
    {
        $this->trackList = [];
    }

    public function addTrack($track)
    {
        $this->trackList[] = $track;
    }

    public function getTrackList()
    {
        $output = '';

        foreach ($this->trackList as $num => $track) {
            $output .= ($num + 1) . ">>{$track}<br/>";
        }

        return $output;
    }

}

//调用
$tracksFromExternalSource = ['a music', 'b music', 'c music'];
$cd = new CD();

foreach ($tracksFromExternalSource as $track) {
    $cd->addTrack($track);
}

print "the CD contains " . $cd->getTrackList();


//需求变更，要求每个输出的音轨采用大写形式


class CDDecorator
{
    private $_cd;

    public function __construct(CD $cd)
    {
        $this->_cd = $cd;
    }

    public function makeCaps()
    {
        foreach ($this->_cd->trackList as &$track){
            $track=strtoupper($track);
        }
    }

}


//调用

$cdDecorator=new CDDecorator($cd);
$cdDecorator->makeCaps(); //这样保证在未修改原始对象结构情况下，对原始对象部分功能或内容进行改造
print "the CD contains " . $cd->getTrackList();

