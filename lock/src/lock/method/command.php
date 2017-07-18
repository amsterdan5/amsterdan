<?php
namespace amsterdan\lock\method;

interface command
{
    public function set($key, $value, $time);
    public function delete($key);
    public function setnx($key, $value, $time);
}