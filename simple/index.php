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

}

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Todo</title>
		<link rel="stylesheet" href="">
	</head>
	<body>
		<section class="todoapp">
      <form method="post" action="" name="new_todo">
        <input type="text" name="todo" />
        <input type="submit" name="submit" text="Create ToDo" />
      </form>
      <ul class="todos">
      <?php
      //retrieve current ToDos from database
      $stmt = $db->query("SELECT * FROM tb_todos");
      $todos = $stmt->fetchAll(PDO::FETCH_OBJ);

      foreach ($todos as $todo) {
        if ( 1 === $todo->done ) {
          //if our todo is marked as done then we'll use the $is_done variable to add a class to our li
          $is_done = ' done';
        }

        echo '<li class="todo' . $is_done . '"><button id="done-' . $todo->id . '" text="Done">' . $todo->todo . '</li>';
      }
      ?>
      </ul>
    </section>
		<footer class="info">

		</footer>

    <script src=""></script>
  </body>
</html>
