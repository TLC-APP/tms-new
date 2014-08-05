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
    public $default1 = array(
        
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'tlc',
        'password' => 'ta8agusa4',
        'database' => 'tlc_thgv',
        'prefix' => '',
        'encoding' => 'utf8'

    );
    public $test = array(
        
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'thgv',
        'prefix' => '',
        'encoding' => 'utf8'
    );
    
    public $dropbox = array(
        'datasource' => 'Dropbox.DropboxSource',
        'consumer_key' => 'm40qhswyyyq8aet',
        'consumer_secret' => '7gfkr22jiaa5jc0',
    );

}
