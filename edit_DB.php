<?php
require_once("dbpwd.php");

if ( isset($_POST['save-list'])) {

	$db->autocommit(FALSE);
	

	$newName = $_POST['name-list'];
	$id = $_POST['id'];
	$sql = "UPDATE lists 
			SET name = '$newName'
			WHERE listid = '$id'";
	


	if($db->query($sql)){
		$db->commit();

	}else{
		outputDBError($db);
	}	

}


if (isset($_POST['delete-list']) ){
	$db->autocommit(FALSE);
	

	$id = $_POST['id'];
	$sql = "DELETE FROM lists 
			WHERE listid = '$id'";

	if($db->query($sql)){
		$db->commit();
	}else{
		outputDBError($db);
	}	


}


if (isset($_POST['add-list']) ){
	$listName = $_POST['newListInput'];
	$sql = "INSERT INTO lists (name, owner_id)
			VALUES ('$listName ', '".$_SESSION['userid']."')";

	if($db->query($sql)){
		$listid = $db->insert_id;
		echo "<script type=\"text/JavaScript\">$(function() { addList( '".$listName ."', '".$listid."');});</script>";
	}else{
		outputDBError($db);
	}	

}

if(isset($_POST['save-task'])){
	$db->autocommit(FALSE);
	

	$newName = $_POST['name-task'];
	$taskid = $_POST['taskid'];
	$desc = $_POST['task-description'];
	$comp = ($_POST['complete'] == 'on')? "1":"0";
	$sql = "UPDATE task 
			SET title = '$newName',
				description = '$desc',
				completed = '$comp'
			WHERE task_id = $taskid";
	


	if($db->query($sql)){
		$db->commit();
	}else{
		outputDBError($db);
	}	
}


if (isset($_POST['delete-task']) ){
	$db->autocommit(FALSE);
	

	$taskid = $_POST['taskid'];
	$sql = "DELETE FROM task 
			WHERE task_id = '$taskid'";

	if($db->query($sql)){
		$db->commit();
	}else{
		outputDBError($db);
	}	


}


if (isset($_POST['add-task']) ){
	$taskName = $_POST['newTaskInput'];
	$listId = $_POST['listId'];
	$sql = "INSERT INTO task (listid, title) VALUES ($listId, '$taskName')";

	if($db->query($sql)){
		$taskid = $db->insert_id;
		echo "<script type=\"text/JavaScript\">$(function() { addTask( '".$taskName ."','',0,".$listId.",".$taskid.");});</script>";
	}else{
		outputDBError($db);
	}	


}


if(isset($_POST['complete'])){
	$db->autocommit(FALSE);

	$comp = ($_POST['complete'] == 'true')? "1":"0";
	$taskid = $_POST['taskid'];
	$sql = "UPDATE task SET completed = '$comp' WHERE task_id = $taskid";
	


	if($db->query($sql)){
		$db->commit();
	}else{
		outputDBError($db);
	}	

}

?>


