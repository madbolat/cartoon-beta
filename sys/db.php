<?php

function connect() {
	try {
		$pdo = new PDO("mysql:dbname=movies;host=".$_SERVER['SERVER_ADDR']."","root","");		
	} catch(PDOException $e) {
		echo "Error: ".$e->getMessage();
		exit;
	}
	return $pdo;
}

function raw($sql, $type = 0) {
	$pdo = connect();
	echo $env['db_name'];
	$res = $pdo->query($sql);
	if($type == 1) {
		$res = $res->fetch(PDO::FETCH_ASSOC);
	} elseif($type == 2) {
		$res = $res;
	} else {
		$res = $res->fetchAll(PDO::FETCH_ASSOC);
	}
	return $res;
}

?>