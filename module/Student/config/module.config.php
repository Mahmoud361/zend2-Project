<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud Mohamed
 * Date: 10/25/2018
 * Time: 1:20 PM
 */

namespace Student;

return array(
    'controllers' => array(
        'invokables' => array(
            'Student\Controller\Student' => 'Student\Controller\StudentController',

        ),
    ),

    'router' => array(
        'routes' => array(
            'student' => array(
                'type' => 'segment',
                'options' =>array(
                    'route' => '/student[/:action][/:id]',
                    'constrains' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'    => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Student\Controller\Student',
                        'action'     => 'index',
                    ),
                ),
            ),
            'new' => array(
                'type' => 'segment',
                'options' =>array(
                    'route' => '/student[/:action][/:id][/:bookid]',
                    'constrains' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'    => '[0-9]+',
                        'bookid'    => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Student\Controller\Student',
                        'action'     => 'index',
                    ),
                ),
            ),


        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'student' => __DIR__ . '/../view',
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













