<?php
return array (
		'controllers' => array (
				'invokables' => array (
						'Product\Controller\Product' => 'Product\Controller\ProductRestController',
						'Product\Controller\ProductCategory' => 'Product\Controller\ProductCategoryRestController', 
						'Product\Controller\Client' => 'Product\Controller\ClientController'
				) 
		),
// 		'router' => array(
// 				'routes' => array(
// 						'Product' => array(
// 								'type'    => 'Literal',
// 								'options' => array(
// 										// Change this to something specific to your module
// 										'route'    => '/product',
// 										'defaults' => array(
// 												// Change this value to reflect the namespace in which
// 												// the controllers for your module are found
// 												'__NAMESPACE__' => 'Product\Controller',
// 												'controller'    => 'Product',
// 										),
// 								),
// 								'may_terminate' => true,
// 								'child_routes' => array(
// 										// This route is a sane default when developing a module;
// 										// as you solidify the routes for your module, however,
// 										// you may want to remove it and replace it with more
// 										// specific routes.
// 										'client' => array(
// 												'type'    => 'Segment',
// 												'options' => array(
// 														'route'    => '/client[/:action]',
// 														'constraints' => array(
// 																'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
// 														),
// 														'defaults' => array(
// 																'controller' => 'Product\Controller\Client',
// 																'action'     => 'index'
// 														),
// 												),
// 										),
// 								),
// 						),
// 				),
// 		),
		// The following section is new and should be added to your file
		'router' => array (
				'routes' => array (
						'product' => array (
								'type' => 'segment',
								'options' => array (
										'route' => '/product[/:id]',
										'constraints' => array (
 												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id' => '[0-9]+' 
										),
										'defaults' => array (
												'controller' => 'Product\Controller\Product',
										) 
								)
						),
						'category' =>array(
								'type' => 'segment',
								'options' => array (
										'route' => '/category[/:id]',
										'constraints' => array (
												'id' => '[0-9]+'
										),
										'defaults' => array (
												'controller' => 'Product\Controller\ProductCategory',
										)
								)
						), 
						'client' => array(
								'type'    => 'segment',
								'options' => array(
										'route'    => '/client[/:table][/:action][/:id]',//
										'defaults' => array(
												'controller' => 'Product\Controller\Client',
												'action'     => 'index'
										),
								),
						),
						
				) 
		),
		
		'view_manager' => array (
				'template_path_stack' => array (
						'product' => __DIR__ . '/../view',
				) ,
				'strategies' => array (
						'ViewJsonStrategy',
				),
				'display_not-found-reason' =>true,
				'display_exceptions' =>true,
				'doctype' =>'HTML5',
		) 
);
