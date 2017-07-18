<?php
namespace lock\method;

abstract class abs
{
    public $instance = [];

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
}