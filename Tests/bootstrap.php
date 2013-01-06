<?php
spl_autoload_register(function ($class) {
  if (0 === strpos(ltrim($class, '/'), 'OBB\Mediaserver')) {
    if (file_exists($file = __DIR__.'/../'.substr(str_replace('\\', '/', $class), strlen('OBB\Mediaserver')).'.php')) {
      require_once $file;
    }
  }
});