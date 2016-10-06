<?php
require_once '../db_config.php';

$db = new PDO('mysql:host=' . $db_info['server'] . ';dbname=' . $db_info['name'] . '', $db_info['user'], $db_info['pass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ( isSet($_GET['id']) ) {
	//process form submission
	$id = $_GET['id'];
	echo '<p>';
	var_dump($id);
	echo '</p>';
	try {
		$stmt = $db->prepare( "DELETE FROM tb_todos WHERE id = :id" );
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
	} catch ( PDOException $e ) {
		echo '<p>ERROR: ' . $e->getMessage() . '</p>';
	}

	header('Location: index.php');
}
