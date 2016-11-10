<?php
require_once '../db_config.php';

$db = new PDO('mysql:host=' . $db_info['server'] . ';dbname=' . $db_info['name'] . '', $db_info['user'], $db_info['pass']);

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Todo</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
		<section id="alerts"></section>
		<section class="todoapp">
      <form method="post" action="insertToDo.php" name="new_todo" id="new_todo">
        <input type="text" name="todo" id="todo" />
        <input type="submit" name="submit" text="Create ToDo" />
      </form>
      <ul class="todos">
      <?php
      //retrieve current ToDos from database
      $stmt = $db->query("SELECT * FROM tb_todos");
      $todos = $stmt->fetchAll(PDO::FETCH_OBJ);

      foreach ($todos as $todo) {
	      echo '<li class="todo" id="todo_' . $todo->id . '"><button type="button" class="btn btn-sm btn-danger" onclick="deleteTodo(' . $todo->id . ');">Done</button> ' . $todo->todo . '</li>';
      }
      ?>
      </ul>
    </section>
		<footer class="info">

		</footer>
		<script   src="http://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script>
			// Attach a submit handler to the form
			$( "#new_todo" ).submit(function( event ) {

				// Stop form from submitting normally
				event.preventDefault();

				// Get some values from elements on the page:
				var $form = $( this ),
					todo = $("#todo").val(),
					url = $form.attr( "action" );

				// Send the data using post
				$.ajax({
						type: "POST",
						url: url,
						data: { todo: todo }, //the first "todo" is the name of the parameter we're passing. It must match the expected name on our insertToDo.php $_POST; The second is our javascript variable that's storing our form's text
						dataType: 'json',
						success: function( data ) {
							var insertedID = data.insertID;
							$( "#alerts" ).empty().append( "Inserted New To Do With the ID: " + insertedID );
							$( ".todos" ).append('<li class="todo" id="todo_' + insertedID + '"><button type="button" class="btn btn-sm btn-danger" onclick="deleteTodo(' + insertedID + ');">Done</button> ' + todo + '</li>' );
							$("#todo").val('');
						},
						error: function(xhr, ajaxOptions, thrownError) {
							alert(xhr.status);
							alert(thrownError);
						}
				});
			 });


			 function deleteTodo( id ){
					var url = 'deleteToDo.php';

					$.ajax({
							type: "POST",
							url: url,
							data: { id: id },
							dataType: 'json',
							success: function( data ) {
								if ('done' == data.message) {
									$( '#todo_' + id ).remove();
								}
							},
							error: function(xhr, ajaxOptions, thrownError) {
				        alert(xhr.status);
				        alert(thrownError);
				      }
						});
				}
		</script>
	</body>
</html>
