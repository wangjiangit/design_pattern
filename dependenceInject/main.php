<?php

function autoload($className)
{
    include_once $className . '.class.php';
}
spl_autoload_register('autoload', true, true);
$container = new Container;

$a = $container->get('A');
$a->test();//输出 'this is C!'
