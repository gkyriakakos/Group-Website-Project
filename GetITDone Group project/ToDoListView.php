<?php
	require_once("authcheck.php");
?>
<!DOCTYPE html>

<html lang = "en">

<head>
	<title>To-Do List</title>
	<link rel="stylesheet" href="stylesFinal.css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src = "script.js"></script>
</head>


<body>
	<div class = "grid-container">

	 	<?php 
			require_once("header.php");
		?>




		<div class = "mainBlock">
			
		<div id ="listContainer">
			<h2>Menu</h2>
			<div id = "listArea">

				<div class = "list-item-permanant">
					<form method = "post" id = "listForm" >
						<input type= "text" name = "newListInput" id ="newListInput">
						<input type = "submit" name = "add-list" value = "+">
					</form>
				</div>
				<div id = "listScroll">

				</div>
			</div>
		</div>


		<div class = "taskContainer">
			<h1 class = "titleBlock" id = "toDoListTitleBlock"></h1>
			<div id = "taskArea">

				<div class = "task-item-permanant">
					<form method = "post">
						<input type = "text" name = "newTaskInput" id ="newTaskInput">
						<input type = "hidden" name = "listId" id = "SelectedlistId">
						<input type = "submit" name = "add-task" value = "+">
					</form>
				<div id = "taskScroll">
				</div>

			
			</div>
		</div>

		</div>

	</div>
		<?php
			require_once ("footer.php");
		?>
	</div>

</body>

</html>

<?php
	include_once("dbpwd.php");
	include_once("load_DB.php");
	include_once("edit_DB.php");
?>
