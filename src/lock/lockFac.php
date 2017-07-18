<?php

namespace lock;

use lock\method\redis;
use \Exception;

class lockFac
{
    private static $servers = [];

    public static function instance(string $method, array $config, int $default = 0)
    {
        if ( !file_exists(__DIR__.'/method/'. strtolower($method) .'.php')) {
            throw new Exception('找不到该方法！');
        }
        $method = strtolower($method);

        if ( !isset(self::$servers[$method])) {
            self::$servers[$method] = ($method::getInstance())->init($config,$default);
        }

        return self::$servers[$method];
    }

    public function changeServer(string $method, int $default)
    {
        if ( !isset(self::$servers[$method])) {
            throw new Exception('找不到该方法！');
        }
        self::$servers[$method]->changeServer($default);
    }
}