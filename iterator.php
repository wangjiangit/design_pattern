<?php

/**
 * 迭代器设计模式可帮助构造特定对象，那些对象能够提供单一标准接口循环或迭代任何类型的可计数数据
 * (给外部代码处理聚合内部元素，不暴露聚合方式)
 */
class IteratorClass implements \Iterator
{

    protected $_data;

    protected $_pos;

    public function __construct($data)
    {
        $this->_data = $data;
        $this->_pos = 0;
    }

    public function current()
    {
        // TODO: Implement current() method.

        $row = $this->_data[$this->_pos];
        $row['ip'] = gethostbyname($row['url']);
        return $row;
    }

    public function next()
    {
        // TODO: Implement next() method.
        $this->_pos++;
    }

    public function key()
    {
        // TODO: Implement key() method.
        return $this->_pos;
    }

    public function valid()
    {
        // TODO: Implement valid() method.
        return $this->_pos >= 0 && $this->_pos < count($this->_data);
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
        $this->_pos = 0;
    }

}


//调用
$data = array(
    array('url' => 'www.baidu.com'),
    array('url' => 'www.tencent.com'),
    array('url' => 'www.alibaba.com'),
    array('url' => 'www.sina.com.cn'),
    array('url' => 'www.kingsoft.com'),
    array('url' => 'www.5izan.com')
);
$iterator = new IteratorClass($data);

foreach ($iterator as $v) {
    echo $v['url'] . '---' . $v['ip'] . '<br/>';
}
