<?php

$listQuery = sprintf("SELECT * FROM lists WHERE owner_id =".$_SESSION['userid'],isset($_GET['o']) ? $db->real_escape_string($_GET['o']) : 'lists');

if ($result = $db->query($listQuery)) {
	
	echo "<script type=\"text/JavaScript\">  
    $(function() {";
    $row = $result->fetch_assoc();
    do{
    	echo "addList( '".$row['name']."', ".$row['listid'].");";
	}while($row = $result->fetch_assoc());

	/* free result set */
	mysqli_free_result($result);
} else {
	outputDBError($db);
}
$taskQuery = sprintf("SELECT * FROM task",isset($_GET['o']) ? $db->real_escape_string($_GET['o']) : 'task');

if ($result = $db->query($taskQuery)) {

	while($row = $result->fetch_assoc()) {
     	echo "addTask( '".$row['title']."', '".$row['description']."', '".$row['completed']."', '".$row['listid']."', '".$row['task_id']."');";
     }

     echo"});</script>";


	/* free result set */
	mysqli_free_result($result);
} else {
	outputDBError($db);
}


?>