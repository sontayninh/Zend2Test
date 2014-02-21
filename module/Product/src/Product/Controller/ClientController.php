<?php
 
namespace Product\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\Client as HttpClient;
use Zend\View\Helper\ViewModel;

/**
 * SampleClientController
 *
 * @author
 *
 * @version
 *
 */
class ClientController extends AbstractActionController {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		$client = new HttpClient();
		$client->setAdapter('Zend\Http\Client\Adapter\Curl');
		//var_dump($client) ;
		$method = $this->params()->fromQuery('method', 'get');
		$table = $this->params()->fromQuery('table','get');
		if ($table=='category') {
			$client->setUri('http://localhost:80'.$this->getRequest()->getBaseUrl().'/category');
		} 
		elseif ($table=='product')
		{
			$client->setUri('http://localhost:80'.$this->getRequest()->getBaseUrl().'/product');
		}
		/*var_dump( $table);
		var_dump( $method);*/
		/*echo '<pre>';.
		 * 
		print_r($client->getUri());
		echo '</pre>' ;*/
		// var_dump($this->getRequest()->getBaseUrl());
		//var_dump($client);
		switch($method) {
			case 'get' :
				
				$client->setMethod('GET');
				$id=$this->params()->fromQuery('id','get');
				$client->setParameterGET(array('id'=>$id));
				
				break;
			case 'getlist' :

				$client->setMethod('GET');

				break;
			case 'create' :
		
				$client->setMethod('POST');
				$client->setParameterPOST(array('name'=>'samsonasik'));

				break;
			case 'update' :

				$data = array('name'=>'ikhsan');
				$adapter = $client->getAdapter();
				 
				$adapter->connect('localhost', 80);
				$uri = $client->getUri().'?id=1';
				// send with PUT Method, with $data parameter
				$adapter->write('PUT', new \Zend\Uri\Uri($uri), 1.1, array(), http_build_query($data));
				 
				$responsecurl = $adapter->read();
				list($headers, $content) = explode("\r\n\r\n", $responsecurl, 2);
				$response = $this->getResponse();

				$response->getHeaders()->addHeaderLine('content-type', 'text/html; charset=utf-8');
				$response->setContent($content);
				return $response;
			case 'delete' :
	
				$adapter = $client->getAdapter();
				 
				$adapter->connect('localhost', 80);
				$uri = $client->getUri().'?id=1'; //send parameter id = 1
				// send with DELETE Method
				$adapter->write('DELETE', new \Zend\Uri\Uri($uri), 1.1, array());
				 
				$responsecurl = $adapter->read();
				list($headers, $content) = explode("\r\n\r\n", $responsecurl, 2);
				$response = $this->getResponse();

				$response->getHeaders()->addHeaderLine('content-type', 'text/html; charset=utf-8');
				$response->setContent($content);
				 
				return $response;
		}
		//if get/get-list/create
		$response = $client->send();
		//echo $response;
		if (!$response->isSuccess()) {
			// report failure
			$message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();
			 
			$response = $this->getResponse();
			$response->setContent($message);
			return $response;
		}
		$body = $response->getBody();
		 
		$response = $this->getResponse();
		$response->setContent($body);
		return $response;
	}
}


// namespace Product\Controller;

// use Zend\Mvc\Controller\AbstractActionController;
// use Zend\View\Model\ViewModel;
// use Zend\Http\Client as HttpClient;

// /**
//  * ClientController
//  *
//  * @author
//  *
//  * @version
//  *
//  */
// class ClientController extends AbstractActionController {
// 	/**
// 	 * The default action - show the home page
// 	 */
// 	public function indexAction() {
// 		// TODO Auto-generated ClientController::indexAction() default action
// // 		echo"aaa";
// 		$client = new HttpClient();
//         $client->setAdapter('Zend\Http\Client\Adapter\Curl');
//          //var_dump($client) ;
//         $method = $this->params()->fromQuery('method', 'get-list');
// //         echo 'http://localhost'.$this->getRequest()->getBaseUrl().'/product';exit;
//         $client->setUri('http://localhost'.$this->getRequest()->getBaseUrl().'/product');
// //          var_dump($this->getRequest()->getBaseUrl());
//         //var_dump($client);
//         switch($method) {
//             case 'get-list' :
//             	//echo "get";
//                 $client->setMethod('GET');
// //                 $client->setParameterGET(array('id'=>1));
//                // var_dump($client);
//                 //exit();
//                 break;
// 		}
// 		$response = $client->send();
// 		if (!$response->isSuccess()) {
// 			// report failure
// 			$message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();

// 			$response = $this->getResponse();
// 			$response->setContent($message);
// 			echo "fail";
// 			return $response;
// 		}
// 		$body = $response->getBody();
	
// 		$response = $this->getResponse();
// 		$response->setContent($body);
// 		echo "Success";
// 		return $response;
// 	}
// }
