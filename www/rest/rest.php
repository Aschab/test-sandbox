<?php

include 'db.php';

class restClass
{
	
	private $table = 'task';
	private $id = 0;
	
	public function __construct(){		
	}
	
	public function get(){
		$return = array('success' => false);
		
		$db = $this->databaseConnection();
		$sql = "SELECT * FROM " . $this->table . " WHERE is_deleted != 1";
		$result = $db->query($sql)->fetchAll();
		if (!$result){
			$return['message'] = 'Database error';
		} 
		else {
			$return = array(
				'success' => true,
				'data' => $result
			);
		}
		
		return $return;
	}

	public function post(){		
		$return = array('success' => false);
		$db = $this->databaseConnection();

		if(!isset($_POST['task']) || !isset($_POST['is_done'])){
			$return['message'] = "Wrong request";
			return $return;
		}
		$task = $_POST['task'];
		$is_done = $_POST['is_done'] == 'true' ? 1 : 0;
	   	$sql = "INSERT INTO " . $this->table . " (task, is_done) VALUES ('" . $task . "', '" . $is_done . "')";
	   	$result = $db->query($sql);
		if (!$result){
			$return['message'] = 'Database error';
		}
		else {
			$return['success'] = true;
		}
		
		return $return;

	}
	
	public function delete($id){
		$db = $this->databaseConnection();
		$sql = "UPDATE " . $this->table . " SET is_deleted = 1 WHERE id = " . $id;
		$result = $db->query($sql);
		if (!$result){
			$return['message'] = 'Database error';
		} 
		else {
			$return['success'] = true;
		}
		
		return $return;
	}
	
	public function databaseConnection(){
		$dbhost = 'mysql';
		$dbuser = 'root';
		$dbpass = 'tiger';
		$dbname = 'png';

		$db = new db($dbhost, $dbuser, $dbpass, $dbname);
		
		return $db;
	}

}