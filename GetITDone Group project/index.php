<?php
session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<title>To-Do List</title>
	<link rel="stylesheet" href="stylesFinal.css">

</head>
<body>

	<?php
	include_once 'header.php';
	?>
	<div id = "indexBody">
		<section>
			<h1 id = "About">About</h1>
			<p>
				“GetItDone” is a web program developed by Joseph Montalvo, George Kyriakakos, Sage Thompson and Rory Finnegan that lets you take back control of your time by providing you a platform to manage your daily tasks and keep your habits.
			</p>
			<p>
				GetItDone gives a clean and simple solution to task management with its minimal design and easy to use interface, allowing you to spend less time organizing your tasks and more time getting them done.
			</p>
		</section>

		<section>
			<h1 id = "HowTo">How To Use</h1>

			<p>
				“GetItDone” is simple to use. First create an account and navigate to your To Do List or Habit tracker area.
			</p>

			<p>
				Once in the To Do List area navigate to the menu area and start tying in the text box to create your first List!
			</p>

			<p>
				To add a task to your new list navigate to the task area in the center and type in the text box to create your first Task!
			</p>

			<p>
				To mark a task as done just click anywhere on the task or check box.
			</p>

			<p>
				Clicking the edit button of your task will show a description of the task and will give you options to change or delete your task.
			</p>

			<p>
				Clicking the edit button of your list will give you options to change or delete your list.
			</p>


		</section>
	</div>

	<?php
	include_once 'footer.php';
	?>
</body>



</html>