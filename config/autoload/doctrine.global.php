<?php
/**
 * Created by PhpStorm.
 * User: Wesley
 * Date: 14/08/2017
 * Time: 06:30
 */

use Doctrine\DBAL\Driver\PDOMySql\Driver as Driver;

return [

    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => Driver::class,
                'params' => [
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'root',
                    'password' => 'root',
                    'dbname' => 'legalizer',
                    'driverOptions' => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ]
                ]
            ]
        ]
    ],
    'authentication' => [
        'orm_default' => [
            'object_manager' => \Doctrine\ORM\EntityManager::class,
            'identity_class' => \User\Entity\Users::class,
            'identity_property' => 'username',
            'credential_property' => 'password',
            'credential_callable' => function (\User\Entity\Users $user, $password) {
                return password_verify($password, $user->getPassword());
            }
        ]
    ]
];