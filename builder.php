<?php

/**
 * 建造者设计模式定义了处理其他对象复杂构建的对象
 * 使用场景：
 * 当创建一个对象很复杂的时候，可以用建造者模式来代替创建对象的复杂过程
 */
class Product
{

    protected $_type = '';

    protected $_size = 0;

    protected $_color = '';

    public function setType($type)
    {
        $this->_type = $type;
    }

    public function setSize($size)
    {
        $this->_size = $size;
    }

    public function setColor($color)
    {
        $this->_color = $color;
    }

    public function show()
    {
        echo '类型：' . $this->_type . '颜色:' . $this->_color . '尺寸:' . $this->_size;
    }

}

//繁琐的构建过程

$productConfigs = ['type' => 'A001', 'color' => 'red', 'size' => 88];
$product = new Product();
$product->setColor($productConfigs['color']);
$product->setSize($productConfigs['size']);
$product->setType($productConfigs['type']);
$product->show();


class ProductBuilder
{

    private $_productConfig = [];

    private $_productObject = null;

    public function __construct($config)
    {
        $this->_productConfig = $config;
        $this->_productObject = new Product();
    }

    public function build()
    {
        $this->_productObject->setType($this->_productConfig['type']);
        $this->_productObject->setSize($this->_productConfig['size']);
        $this->_productObject->setColor($this->_productConfig['color']);
    }

    public function getProduct()
    {
        return $this->_productObject;
    }
}

$productBuilder = new ProductBuilder($productConfigs);
$productBuilder->build();
$product = $productBuilder->getProduct();
$product->show();

