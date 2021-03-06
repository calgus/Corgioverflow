<?php
define('DB_PASSWORD', 'YOUR PASSWORD');
return [
    // Set up details on how to connect to the database
    'dsn'     => "mysql:host=HOSTNAME;dbname=DATABASENAME;",
    'username'        => "YOUR USERNAME",
    'password'        => DB_PASSWORD,
    'driver_options'  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    'table_prefix'    => "corgi_",

    // Display details on what happens
    //'verbose' => true,

    // Throw a more verbose exception when failing to connect
    //'debug_connect' => 'true',
];
