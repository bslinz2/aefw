<?php

class Config {

    protected static $basePath = __DIR__ . '/../config';
    
    public static function get($path) {
        $path = explode('.', $path);
        
        if(!is_array($path) || count($path) < 2) {
            throw new Exception('requested config property must contain two values separated by a period!');
        }

        $file = sprintf('%s/%s.php', self::$basePath, $path[0]);

        if(!file_exists($file)) {
            throw new Exception('request config file does not exist!');
        }

        $config = include $file;

        if(!is_array($config)) {
            throw new Exception('the requested config file must return an array!');
        }

        if($path[1] == '*') {
            return $config;
        }

        if(!array_key_exists($path[1], $config)) {
            throw new Exception('the requested config value is not set!');
        }

        return $config[$path[1]];
    }
}