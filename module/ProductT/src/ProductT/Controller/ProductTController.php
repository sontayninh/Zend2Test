<?php

namespace ProductT\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Config\Reader\Json;
use Zend\View\Model\JsonModel;
use Zend\Http\Client as HttpClient;

class ProductTController extends AbstractActionController {
	public function indexAction() {
		$data = $this->readProductJson ( 'getlist', 'product', '' );
		//$result = json_decode($data->getContent();
		$content = $data->getContent();
		$jsonResult = json_decode($content,true);
		return array (
				'categories' => $jsonResult['categories'],
		);
	}
	public function getDataAction() {
		$id = $this->params ()->fromQuery ( 'idProduct' ) - 1;
		$data = $this->readJson ();
		$product = $data ['categories'] [$id] ['_embedded'] ['products'] [0];
		$result = new JsonModel ( array (
				'product' => $product,
				'success' => true 
		) );
		return $result;
	}
	private function readJson() {
		$reader = new Json ();
		$data = $reader->fromFile ( './json/hal_product.json' );
		return $data;
	}
	private function readProductJson($method_arg, $table_arg, $url_arg) {
		$client = new HttpClient ();
		$client->setAdapter ( 'Zend\Http\Client\Adapter\Curl' );
		// var_dump($client) ;
		if (isset ( $method_arg ) == true && isset ( $table_arg ) == true && isset ( $url_arg ) == true) {
			$method = $method_arg;
			$table = $table_arg;
		} else {
			$method = $this->params ()->fromQuery ( 'method', 'get' );
			$table = $this->params ()->fromQuery ( 'table', 'get' );
		}
		if ($table == 'category') {
			$client->setUri ( 'http://localhost:8088' . $this->getRequest ()->getBaseUrl () . '/category' );
		} elseif ($table == 'product') {
			$client->setUri ( 'http://localhost:8088' . $this->getRequest ()->getBaseUrl () . '/product' );
		}
		// var_dump( $table);
		// var_dump( $method);
		/*
		 * echo '<pre>';. print_r($client->getUri()); echo '</pre>' ;
		 */
		// var_dump($this->getRequest()->getBaseUrl());
		// var_dump($client);
		switch ($method) {
			case 'get' :
				
				$client->setMethod ( 'GET' );
				$id = $this->params ()->fromQuery ( 'id', 'get' );
				$client->setParameterGET ( array (
						'id' => $id 
				) );
				
				break;
			case 'getlist' :
				
				$client->setMethod ( 'GET' );
				
				break;
			case 'create' :
				
				$client->setMethod ( 'POST' );
				$client->setParameterPOST ( array (
						'name' => 'samsonasik' 
				) );
				
				break;
			case 'update' :
				
				$data = array (
						'name' => 'ikhsan' 
				);
				$adapter = $client->getAdapter ();
				
				$adapter->connect ( 'localhost', 80 );
				$uri = $client->getUri () . '?id=1';
				// send with PUT Method, with $data parameter
				$adapter->write ( 'PUT', new \Zend\Uri\Uri ( $uri ), 1.1, array (), http_build_query ( $data ) );
				
				$responsecurl = $adapter->read ();
				list ( $headers, $content ) = explode ( "\r\n\r\n", $responsecurl, 2 );
				$response = $this->getResponse ();
				
				$response->getHeaders ()->addHeaderLine ( 'content-type', 'text/html; charset=utf-8' );
				$response->setContent ( $content );
				return $response;
			case 'delete' :
				
				$adapter = $client->getAdapter ();
				
				$adapter->connect ( 'localhost', 80 );
				$uri = $client->getUri () . '?id=1'; // send parameter id = 1
				                                  // send with DELETE Method
				$adapter->write ( 'DELETE', new \Zend\Uri\Uri ( $uri ), 1.1, array () );
				
				$responsecurl = $adapter->read ();
				list ( $headers, $content ) = explode ( "\r\n\r\n", $responsecurl, 2 );
				$response = $this->getResponse ();
				
				$response->getHeaders ()->addHeaderLine ( 'content-type', 'text/html; charset=utf-8' );
				$response->setContent ( $content );
				
				return $response;
		}
		// if get/get-list/create
		$response = $client->send ();
		// echo $response;
		if (! $response->isSuccess ()) {
			// report failure
			$message = $response->getStatusCode () . ': ' . $response->getReasonPhrase ();
			
			$response = $this->getResponse ();
			$response->setContent ( $message );
			return $response;
		}
		$body = $response->getBody ();
		
		$response = $this->getResponse ();
		$response->setContent ( $body );
		return $response;
	}
}