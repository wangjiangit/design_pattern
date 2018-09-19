<?php

/**
 * 适配器设计模式
 * 将某个对象的接口适配为另一个对象所期望的接口,
 * 理解：适配器模式为已有的对象定义了新的接口，从而能够匹配新对象的要求.
 */
class ErrorObject
{

    private $_error;

    public function __construct($error)
    {
        $this->_error = $error;
    }

    public function getError()
    {

        return $this->_error;
    }

}


class LogToConsole
{
    private $_errorObject;

    public function __construct(ErrorObject $errorObject)
    {
        $this->_errorObject = $errorObject;
    }

    public function write()
    {
        fwrite(STDERR, $this->_errorObject->getError());
    }
}

//现在需求要将错误日志写入CSV文件


class LogToCSVErrorObjectAdapter extends ErrorObject
{
    private $_errorNumber, $_errorText;

    public function __construct($error)
    {
        parent::__construct($error);

        $parts = explode(':', $this->getError());
        $this->_errorNumber = $parts[0];
        $this->_errorText = $parts[1];
    }

    public function getErrorNumber()
    {

        return $this->_errorNumber;
    }

    public function getErrorText()
    {
        return $this->_errorText;
    }

}

class LogToCSV
{

    const CSV_POSITION = 'log.csv';

    private $_errorObject;

    public function __construct(LogToCSVErrorObjectAdapter $errorObject)
    {
        $this->_errorObject = $errorObject;
    }

    public function write()
    {
        $line = '';
        $line .= $this->_errorObject->getErrorNumber();
        $line .= ',';
        $line .= $this->_errorObject->getErrorText();
        $line .= "\n";
        file_put_contents(self::CSV_POSITION, $line, FILE_APPEND);
    }
}


//调用

$errorObjectAdapter = new LogToCSVErrorObjectAdapter('404:Not Found');

$log = new LogToCSV($errorObjectAdapter);

$log->write();