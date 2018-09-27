<?php

/**
 * (单例模式)
 * 通过提供对自身共享实例的访问，单元素设计模式用于限制特定对象只能被创建一次
 */
class DBConnection
{

    protected static $instance = null;

    private $_username;

    private $_password;

    private $_host;

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initConfig(Array $array)
    {
        $this->_username = $array['username'];
        $this->_password = $array['password'];
        $this->_host = $array['host'];
    }

    public function initShow()
    {
        $initString = <<<initString
连接正在初始化...
{$this->_username}-----{$this->_password}----{$this->_host}

initString;

        echo $initString;
    }

}


//调用
DBConnection::getInstance()->initConfig(['username'=>'root','password'=>'123456','host'=>'www.5izan.com']);
DBConnection::getInstance()->initShow();