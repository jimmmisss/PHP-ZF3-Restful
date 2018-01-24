<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [

            'inicio' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action' => 'user'
                    ],
                ],
            ],

            'user' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/api/user[/:id]',
                    'defaults' => [
                        'controller' => Controller\UserRestController::class,
                    ],
                ],
            ],

        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy'
        ],
    ],

    'doctrine' => [
        'driver' => [
            'User_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'User\Entity' => 'User_driver'
                ]
            ]
        ],

        'fixtures' => [
            'UserFixture' => __DIR__ . '/../src/Fixture'
        ]
    ],

];