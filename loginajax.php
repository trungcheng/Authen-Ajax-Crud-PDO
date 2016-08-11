<?php
	// var_dump($_POST['username']);die;
	session_start();
	require('db.php');

	$user = array();

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	$query = $conn->prepare("SELECT username,password FROM user WHERE username=:username AND password=:password");
	$query->bindParam(":username", $username);
	$query->bindParam(":password", $password);
	$query->execute();
	$result = $query->fetch();
	if($result && count($result)>0){
		$_SESSION['user'] = $result;
		echo json_encode($result);
	}else{
		echo json_encode($user);
	}
?>