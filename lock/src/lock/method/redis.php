<?php
namespace amsterdan\lock\method;
use RuntimeException;
class Redis extends abs implements command
{
    public $servers = [];

    public $defServer = NULL;

    public function init(array $configs, int $default = 0)
    {
        if(empty($this->servers)) {
            foreach($configs as $config) {
                if( !$config['host'] || !$config['port']) {
                    throw new RuntimeException('非法地址');
                }
                $redis = new \Redis();
                $redis->connect($config['host'], $config['port']);
                $this->servers[] = $redis;
            }
        }
        $this->defServer = $default;
        return $this->servers;
    }

    public function changeServer(int $default)
    {
        if(isset($this->servers[$default])) {
            $this->defServer = $default;
            return true;
        }
        throw new RuntimeException('实例不存在');
    }
    
    public function delete($key)
    {
        return $this->servers[$this->defServer]->del($key);
    }

    public function set($key, $name, $time = 0)
    {
        if ($time) {
            return $this->servers[$this->defServer]->setnx($key, $name, $time);
        }
        return $this->servers[$this->defServer]->set($key, $name);
    }

    public function get($key)
    {
        return $this->servers[$this->defServer]->get($key);
    }

    public function setnx($key, $name, $time = 0)
    {
        return $this->servers[$this->defServer]->setnx($key, $name, $time);
    }
}