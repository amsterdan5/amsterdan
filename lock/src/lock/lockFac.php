<?php

namespace amsterdan\lock;

use amsterdan\lock\method\redis;

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
            self::methodFactory($method)->init($config,$default);
            self::$servers[$method] = self::methodFactory($method);
        }

        return self::$servers[$method];
    }

    public static function methodFactory(string $method)
    {
        switch($method)
        {
            case 'redis':
                return redis::getInstance();
        }
        throw new Exception('找不到该方法！');
    }

    public static function changeServer(string $method, int $default)
    {
        if ( !isset(self::$servers[$method])) {
            throw new Exception('找不到该方法！');
        }
        self::$servers[$method]->changeServer($default);
        return self::$servers[$method];
    }
}