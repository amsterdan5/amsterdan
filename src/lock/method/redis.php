<?php
namespace lock\method;

class Redis extends abs implements lockIf
{
    public $servers = [];

    public $defServer = NULL;

    public function init(array $configs, int $default = 0)
    {
        if( !empty($this->servers)) {
            foreach($configs as $config) {
                if( !$config['host'] || !$config['port']) {
                    throw new RuntimeException('非法地址');
                }
                $this->servers[] = Redis::connection($config['host'], $config['port']);
            }
        }
        $this->defServer = $default;
        return $this->servers;
    }

    public function changeServer(int $default)
    {
        if(isset($this->server[$default])) {
            $this->defServer = $default;
        }
        throw new RuntimeException('实例不存在');
    }

    public function add($key, $name)
    {
        return $this->servers[$this->defServer]->add($key, $name);
    }
    
    public function delete($key)
    {
        return $this->servers[$this->defServer]->del($key);
    }
}