<?php

require_once __DIR__.'/../vendor/autoload.php';

use lock\lockFac;

// var_dump(lockFac::class);exit;

$config = [['host'=>'192.168.35.128','port'=>6379],['host'=>'192.168.35.128','port'=>6379]];
$content = lockFac::instance('redis', $config);
// var_dump($content);
// $content = lockFac::changeServer('redis', 1);
$content->set('composer','ok3');
// $hello = $content->get('hello');
// $content->test('composer','ok2');
var_dump($content);