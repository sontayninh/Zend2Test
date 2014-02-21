<?php
return array (
		'controllers' => array (
				'invokables' => array (
						'ProductT\Controller\ProductT' => 'ProductT\Controller\ProductTController' 
				) 
		),
		
		'router' => array (
				'routes' => array (
						'productt' => array (
								'type' => 'segment',
								'options' => array (
										'route' => '/productt[/][:action][/:id]',
										'constraints' => array (
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id' => '[0-9]+' 
										),
										'defaults' => array (
												'controller' => 'ProductT\Controller\ProductT',
												'action' => 'index' 
										) 
								) 
						) 
				) 
		),
		
		'view_manager' => array (
				'display_not_found_reason' => true,
				'display_exceptions' => true,
				'doctype' => 'HTML5',
				'not_found_template' => 'error/404',
				'exception_template' => 'error/index',
				'template_map' => array (
						'layout/layout' => __DIR__ . '/../view/layout/layout.phtml' 
				// 'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
				// 'error/404' => __DIR__ . '/../view/error/404.phtml',
				// 'error/index' => __DIR__ . '/../view/error/index.phtml',
								),
				'template_path_stack' => array (
						__DIR__ . '/../view' 
				),
				'strategies' => array (
						'ViewJsonStrategy' 
				) 
		) 
);