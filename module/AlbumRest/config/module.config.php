<?php
return array (
		'controllers' => array (
				'invokables' => array (
						'AlbumRest\Controller\AlbumRest' => 'AlbumRest\Controller\AlbumRestController' 
				) 
		),
		'router' => array (
				'routes' => array (
						'album-rest' => array (
								'type' => 'segment',
								'options' => array (
										'route' => '/album-rest[/:id]',
										'constraints' => array (
												'id' => '[0-9]+' 
										),
										'defaults' => array (
												'controller' => 'AlbumRest\Controller\AlbumRest',
												'action' => 'getList' 
										) 
								) 
						) 
				) 
		),
		'view_manager' => array (
				'template_path_stack' => array (
						'album-rest' => __DIR__ . '/../view' 
				),
				'strategies' => array (
						'ViewJsonStrategy' 
				) 
		) 
);