<?php

require_once("dbpwd.php"); //Creates a $db mysqli object and connects to DB

//From is used to send the user to the page that they tried to access before logging in
$from = isset($_POST['from']) ? $_POST['from'] : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "ToDoListView.php");

//Starts session/cookie management
session_start();

$msg = "Login to access this area";

if ( isset($_SESSION['username']) && isset($_SESSION['userid'])) {
	//already logged in
	redirect($from);
} elseif ( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['from']) ) {
	$sql = sprintf("
		SELECT username,userid
		FROM users
		WHERE username='%s' AND password=SHA2('%s',256)
	",$db->real_escape_string($_POST['username']),$db->real_escape_string($_POST['password']));
	
	if ( $result = $db->query($sql) ) {

		if ($result && $result->num_rows == 1 ) {
			$u = $result->fetch_assoc();
			$_SESSION['username'] = $u['username'];
			$_SESSION['userid'] = $u['userid'];
			//Update users lastlogin
			// $db->query("UPDATE users SET lastlogin=NOW() WHERE username = '". $u['username']  ."'");
			redirect($_POST['from']);	
		} else {
			$msg = "Incorrect userid and/or password.";
		}
	} else {
		outputDBError($db);
	}
}

?>
<!DOCTYPE html>
<!-- First HTML5 example. -->
<html>
   <head>
      <meta charset = "utf-8">
      <title>Login</title>
	  <link href="/~smiller/common.css" rel="stylesheet" type="text/css">
   </head>
	
	<body class="loginform">
		
		<div class="loginform centered">
		<form method="post">
			
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
				<input id="loginbutton" type="submit" value="login">
			</p>
		</form>
		</div>
   </body>
</html>
