<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud Mohamed
 * Date: 10/28/2018
 * Time: 10:39 AM
 */

namespace Book;

return array(
    'controllers' => array(
        'invokables' => array(
            'Book\Controller\Book' => 'Book\Controller\BookController',

        ),
    ),

    'router' => array(
        'routes' => array(
            'book' => array(
                'type' => 'segment',
                'options' =>array(
                    'route' => '/book[/:action][/:id]',
                    'constrains' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'    => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Book\Controller\Book',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'book' => __DIR__ . '/../view',
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    )

);