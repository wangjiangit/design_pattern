<?php

/**
 * DAO(数据访问对象模式)
 * 数据访问对象模式是描述了如何创建提供透明访问任何数据源的对象
 * 这种设计模式的目的是：重复和数据源抽象化
 *
 * 优点：提供数据库抽象层
 */
abstract class baseDAO
{

    private $_connection;

    protected $_primaryKey = 'id';

    protected $_tableName = '';

    public function __construct()
    {
        $this->_connectToDB(DB_USER, DB_PASS, DB_HOST, DB_DATABASE);
    }

    private function _connectToDB($user, $pass, $host, $database)
    {
        $this->_connection = mysql_connect($host, $user, $pass);
        mysql_select_db($database, $this->_connection);
    }


    public function fetch($value, $key = null)
    {

        if (is_null($key)) {
            $key = $this->_primaryKey;
        }

        $sql = "SELECT * FROM {$this->_tableName } WHERE {$key}='{$value}'";
        $resultsRes = mysql_query($sql, $this->_connection);
        $rows = array();

        while ($result = mysql_fetch_assoc($resultsRes)) {

            $rows[] = $result;

        }

        return $rows;

    }


    public function update($keyedArray)
    {

        $sql = "UPDATE {$this->_tableName }  set ";
        $updates = array();

        foreach ($keyedArray as $column => $value) {

            $updates[] = "{$column} ='{$value} ' ";
        }

        $sql .= implode(',', $updates);
        $sql .= "WHERE {$this->_primaryKey} ='{$keyedArray[$this-> _primaryKey] }'";
        mysql_query($sql, $this->_connection);

    }

}


class UserDAO extends baseDAO
{
    protected $_tableName = 'user';
    protected $_primaryKey = 'id';

    public function getUserByFirstName($name)
    {
        $result = $this->fetch($name, 'firstname');
        return $result;
    }

}


//调用

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '123456');
define('DB_DATABASE', 'test');

$userObject = new UserDAO();
$userArr = $userObject->getUserByFirstName('jian');
var_dump($userArr);
$userObject->update(array('id' => 3, 'lastname' => 'chen'));