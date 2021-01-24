	<header class = "nav">
		<img class = "logo" src="logo.jpg" alt = "company logo" width = "75" height = "50">
		<nav>
			<ul class = "nav_links">

				<?php
				if ( !isset($_SESSION['username']) && !isset($_SESSION['userid'])){
				echo "<li><a href='dblogin.php'>Sign-in</a></li>";
				echo "<li><a href='dbsignup.php'>Sign-up</a></li>";
				}else{
				echo "<li><a href='dblogout.php'>Sign-Out</a></li>";
				}
				?>
				<li><a href="index.php">About/How To Use</a></li>
				<li><a href="dashboard.php">My Dashboard</a></li>
			</ul>
		</nav>
	</header>