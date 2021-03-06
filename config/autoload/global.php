<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
//var_dump(dirname('C:\xampp\htdocs\zf2\student\testmustache') );die();
return array(
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=zf2tutorial;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
            => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'mustache' => array(
        'suffix' => 'phtml',
        'pragmas' => array(
            Mustache_Engine::PRAGMA_BLOCKS
        ),
//        'partials_loader' => array(
//            "C:/xampp/htdocs/zf2/module/Student/view/student/student",
//            "extension" => ".phtml"
//        )
    ),
);
