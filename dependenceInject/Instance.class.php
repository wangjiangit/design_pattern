<?php
/**
 * Class Instance.class
 * 该类主要用于记录类的名称，标示是否需要获取实例
 */
class Instance{
    /**
     * @var 类唯一标示
     */
    public $id;

    /**
     * 构造函数
     * @param string $id 类唯一ID
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * 获取类的实例
     * @param string $id 类唯一ID
     * @return Object Instance.class
     */
    public static function getInstance($id)
    {
        return new self($id);
    }
}
