<?php

class DATABASE_CONFIG {

    public $default = array(
        
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'thgv',
        'prefix' => '',
        'encoding' => 'utf8'

    );
    public $test = array(
        
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'thgv_test',
        'prefix' => '',
        'encoding' => 'utf8'
    );
    
}
