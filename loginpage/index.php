<?php
//pull in our database configurating variables
require_once '../db_config.php';

//set up a connection to our database
$db = new PDO('mysql:host=' . $db_info['server'] . ';dbname=' . $db_info['name'] . '', $db_info['user'], $db_info['pass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ( isSet($_POST['user_name']) && isSet($_POST['password']) ) {
  //process login
  $user_name = $_POST['user_name'];
  $password = $_POST['password'];

/*
  //old way with hard coded user/pass
  $good_user_name = 'clint';
  $good_password = '12345';

  if ($good_user_name == $user_name) {
    //we know the user is correct
    if($good_password == $password) {
      //good password
      setcookie("loggedin", true, time()+3600);
      header('Location:loggedin.php');
    } else {
      //bad password
      $error = 'Bad Password';

    }
  } else {
    //bad Username
    $error = 'Bad Username';
  }
  //end old way
*/

  //new way with database check
  try {
		$stmt = $db->prepare( "SELECT user_id, access_level from tb_users where user_name = :user_name AND password = :password" );
		$stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
		$logged_in_user = $stmt->fetch(PDO::FETCH_OBJ);

    if ( 0 < $logged_in_user->user_id ) {
      //this is a successful login
      setcookie("loggedin", true, time()+3600);
      setcookie("user_name", $user_name, time()+3600);
      setcookie("access_level", $logged_in_user->access_level, time()+3600);

      header('Location:loggedin.php');
    } else {
      //unsuccessful login
      $error = 'There was an error with your login, please try again.';

    }

	} catch ( PDOException $e ) {
		//very basic error handling
		echo '<p>ERROR: ' . $e->getMessage() . '</p>';
	}

  echo '<div class="user_data">';
    echo 'Submitted Username = ' . $user_name . '<br />';
    echo 'Submitted Password = ' . $password . '<br />';
  echo '</div>';
}
 ?>
 <html>
 <head>
 </head>
 <body>
   <div class="err_message"><?php
   if (isSet($error)) {
     echo $error . '  Please try again.';
   }
   ?></div>
   <form action="" method="post" name="login">
     User Name: <input type="text" name="user_name" value="<?php echo $user_name;?>"/><br />
     Password: <input type="password" name="password" /><br />
     <input type="submit" name="submit" value="Login" />

   </form>
 </body>
