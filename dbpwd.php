<?php
/*
By S. Miller

1. Your database userid should be the same as your tophat userid

2. Your database password is NOT the same.  Your password should be saved to a text file in your home directory
called db.txt.  This password is typically four random words seperated by spaces.

3. This script reads the text file and stores it in a variable named DBPWD, connects to the database, then deletes (unsets)
the password variable so that it will not accidently be sent as output to the browser

*/

//UPDATE THESE FIELDS!!
$DB_USERNAME = "webgroup1"; //Your userid for tophat/database server, this is case senstitive
$DB_DATABASE = "webgroup1_default"; //Name of your database, the default is yourusername_default, this is case senstitive

$dbpwdPath = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . "/../db.txt";
$db = false; //Mysqli Object 

if (file_exists($dbpwdPath)) {
	 //DBPwd file exists
	 $DBPWD = trim(file_get_contents($dbpwdPath));
	 
	 $db = new mysqli("localhost", $DB_USERNAME, $DBPWD, $DB_DATABASE );
	 if ($db->connect_errno) {
		  echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
	 }
	 
	 unset($DBPWD);

} else {
	 
	 trigger_error("Users db.txt file missing, unable to use DB, error=".$db->error, E_USER_ERROR);

}

//Global functions

//redirect
//Convenience function to redirect to another page, however, only works if NO output was already sent to browser
function redirect($to) {
	header('Location: ' . $to, true, 302);
	exit(1); //To make sure nothing else gets executed, location only works if nothing already sent to browser
}

//Nice function to output a "friendly" mysql error when the query does not execute as you think it should
function outputDBError($db) {
	 echo "<pre>";
	 if ($db->error) {
		  try {    
			   throw new Exception("MySQL error $db->error", $db->errno);    
		  } catch(Exception $e ) {
			   printf("Error No: %d<br>%s<br>",$e->getCode(),$e->getMessage());
			   echo nl2br($e->getTraceAsString());
		  }
	 } else {
		  throw new Exception("Unknown db issue");    
	 }
}
?>
