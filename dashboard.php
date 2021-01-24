<?php
	require_once("authcheck.php");
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="stylesFinal.css">
</head>
<body id = "dashboardBody">

	<?php
		include_once 'header.php';
	?>
	


		<div class = "buttonArea">

			<div id = "toDoListButton">

				<a href="ToDoListView.php">
					<img src="list.svg" alt= "image of a to do list">
				</a>

			</div>

			<div id = "habitTrackerButton">

				<a href="habitTrackerView.php" style="pointer-events: none">
					<img src="calendar.svg" alt = "image of a habit tracker">
				</a>

			</div>


	</div>

	<?php
		include_once 'footer.php';
	?>


</body>



</html>