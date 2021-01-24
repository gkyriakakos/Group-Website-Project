<?php

session_start();

function isLoggedIn() 
{
	if ( isset($_SESSION['username']) && isset($_SESSION['userid']))
		return true;
	return false;
}

if ( !isLoggedIn() )
	header('Location: dblogin.php', true, 302);
?>
