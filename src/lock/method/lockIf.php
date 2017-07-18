<?php
namespace lock\method;

interface LockIf
{
    public function add($key, $value);
    public function set($key, $value);
    public function delete($key);
}