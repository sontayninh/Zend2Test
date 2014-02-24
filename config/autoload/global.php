<?php
use Zend\Db\Adapter\Adapter;
return array (
		'db' => array (
				'driver' => 'Pdo',
				'dsn' => 'mysql:dbname=test;host=localhost',
				'driver_options' => array (
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
				),
				'username'=> 'root',
				'password'=>'',
		),
		'service_manager' => array (
				'factories' => array (
						'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory' 
				) 
		),
);