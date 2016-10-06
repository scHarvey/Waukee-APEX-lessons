<?php
//database info
$db_server = 'todo.clintharvey.net';
$db_name = 'mysql';
$db_user = 'todo_user';
$db_pass = 'ThisIsNotAGreatPassword';

$db = new PDO('mysql:host=' . $db_server . ';dbname=' . $db_name . ';charset=utf8mb4', $db_user, $db_pass);

if ( true === $submit ) {
  //process form submission
  $todo = $_POST['todo'];
  $done = false;

  $stmt = $db->prepare("INSERT INTO tb_todos("todo","done") VALUES(:todo,:done)");
  $stmt->execute(array(':todo' => $todo, ':done' => $done));

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
      return $stmt->fetchAll(PDO::FETCH_OBJ);

      $todos = /*[PDO FETCH]*/;
      foreach ($todos as $todo) {
        if ( true === $todo->done ) {
          //if out todo is marked as done then we'll use the $is_done variable to add a class to our li
          $is_done = ' done';
        }

        echo '<li class="todo' . $id_done . '"><button id="done-' . $todo->id . '" text="Done">' . $todo->todo . '</li>';
      }
      ?>
      </ul>
    </section>
		<footer class="info">

		</footer>

    <script src=""></script>
  </body>
</html>
