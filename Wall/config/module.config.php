<?php
/**
 * Based in zend framework 2 here we have an API with the routers this
 * file manipulates what controllers, factories, views, and any configuration
 * can be called and apply a pattern
 * called factory (the framework load the factory and inject the dependencies
 * in this case to the controller)
 */
return array(
    'controllers' => array(
        'factories' => array(
            'Wall\Controller\Index' => 'Wall\Controller\IndexControllerFactory'
        ),
    ),
    'router' => array(
        'routes' => array(
            'wall' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/api/wall[/:id]',
                    'constraints' => array(
                        'id' => '\w+'
                    ),
                    'defaults' => array(
                        'controller' => 'Wall\Controller\Index'
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
