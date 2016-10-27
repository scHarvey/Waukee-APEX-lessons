<?php
$loggedin = $_COOKIE['loggedin'];

if($loggedin) {
  //this was a successful logged in user
  //update their cookie
  $user_name = $_COOKIE['user_name'];
  $access_level = $_COOKIE['access_level'];

  setcookie("loggedin", true, time()+3600);
  setcookie("user_name", $user_name, time()+3600);
  setcookie("access_level", $access_level, time()+3600);
} else {

  //nonlogged in user
  header('Location:index.php');
}


 ?>
 <html>
  <head>
  </head>
  <body>
    Success Logging In: <?php echo $user_name;?><br />

    <?php
      if ( 0 == $access_level ) {
        print("<p>If you're seeing this then you have been granted Access Level 0. <br />Congratulations.</p>");
      }
    ?>
  </body>
</html>
