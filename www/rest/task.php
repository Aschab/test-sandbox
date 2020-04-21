<?php

include 'rest.php';

$rest = new restClass();

$return = array('success' => false);

switch($_SERVER['REQUEST_METHOD']) {
		
	case "GET":
		$return = $rest->get();
		break;
		
	case "POST":		
		$return = $rest->post();		   
		break;
		
	case "DELETE":			
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri = explode( '/', $uri );
		$id = (int) end($uri);
		$return = $rest->delete($id);
		break;
		
	default:
		$return['message'] = "Wrong request";
}

echo json_encode($return);


