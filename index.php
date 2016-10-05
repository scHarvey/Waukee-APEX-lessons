<?php

if ( true === $submit ) {
  //process form submission
    
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

      //[INSERT PDO CODE HERE]
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
