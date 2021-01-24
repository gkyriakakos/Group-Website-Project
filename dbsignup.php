<?php
require_once("dbpwd.php");

$from = isset($_POST['from']) ? $_POST['from'] : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "dashboard.php");

session_start();

$msg = "Register to access this area";

if (isset($_POST['signup'])) {


    echo $msg;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, password) VALUES ('$username', SHA2('$password', 256))";



    if($db->query($sql)){
		$msg = "Your signed up!";
    }else{
    	$msg = "There was a problem!";
    }


    $_SESSION['userid'] = $db->insert_id;
    $_SESSION['username'] = $username;

    redirect($from);
}

?>

<!DOCTYPE html>

<html>
   <head>
      <meta charset = "utf-8">
      <title>Login</title>
      <link href="/~smiller/common.css" rel="stylesheet" type="text/css">
   </head>
    
    <body class="loginform">
        
        <div class="loginform centered">
        <form method="post" action = "dbsignup.php">
        	<div class="key"></div>
        	<h3><?php echo $msg; ?></h3>
            <label>
                Username:
                <input name="username" type="text" value="">
            </label>
            <p>
            <label>
                Password:
                <input name="password" type="password" value="">
            </label>
            <p style="text-align: center;">
            	<input name="from" type="hidden" value="<?php echo $from; ?>">
                <input class="form-btn" type="submit" name="signup" value="Sign-up">
            </p>
        </form>
        </div>
   </body>
</html>