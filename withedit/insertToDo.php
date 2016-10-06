<?php
require_once '../db_config.php';

$db = new PDO('mysql:host=' . $db_info['server'] . ';dbname=' . $db_info['name'] . '', $db_info['user'], $db_info['pass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ( isSet($_POST['todo']) ) {
	//process form submission
	$todo = $_POST['todo'];
	$done = 0;
	try {
		$stmt = $db->prepare( "INSERT INTO tb_todos(todo, done) VALUES(:todo, :done)" );
		$stmt->execute( array( ':todo' => $todo, ':done' => $done ) );
	} catch ( PDOException $e ) {
		echo '<p>ERROR: ' . $e->getMessage() . '</p>';
	}
	
	//the autoincremented ID for the todo we just inserted
	//not really using this at the moment, but we might want to later (foreshadowing)
	$insertId = $db->lastInsertId();

  $host  = $_SERVER['HTTP_HOST'];
  header('Location: ' . $host . '/index.php');
}
