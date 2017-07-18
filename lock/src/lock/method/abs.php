<?php
namespace amsterdan\lock\method;

abstract class abs
{
    public static $instance = [];

    public function __construct()
    {
    }

    public static function getInstance()
    {
        $className = get_class();
        if ( !isset(self::$instance[$className])) {
            self::$instance[$className] = new static();
        }
        return self::$instance[$className];
    }

    public function __call($method, $args)
    {
        throw new RuntimeException('不存在的方法:'. $method. ',args: '. json_encode((array)$args,true));
    }
}