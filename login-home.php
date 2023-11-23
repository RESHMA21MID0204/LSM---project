<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[car_id])
	{
		$SQL="SELECT * FROM car WHERE car_id = $_REQUEST[car_id]";
		$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
		$data=mysqli_fetch_assoc($rs);
	}
?> 
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1">
			<div class="contact">
					<h4 class="heading colr">Welcome to Event Management System</h4>
					<div class='msg'><?=$_REQUEST['msg']?></div>
					<ul class="login-home">
					<?php if($_SESSION['user_details']['user_level_id'] == 1) { ?> 
						  <li><a href="event.php">Add New Event</a></li>
						  <li><a href="task.php">Add Task</a></li>
						  <li><a href="programs.php">Add Event Program</a></li>
						  <li><a href="program_type.php">Add Program Type</a></li>
						  <li><a href="theme.php">Add New Theme</a></li>
						  <li><a href="user.php">Add User</a></li>
						  <li><a href="event-report.php">Event Report</a></li>
						  <li><a href="task-report.php">Task Report</a></li>
						  <li><a href="program_type-report.php">Program Type Report</a></li>
						  <li><a href="programs-report.php">Program Report</a></li>
						  <li><a href="theme-report.php">Theme Reports</a></li>
						  <li><a href="user-report.php">Users Report</a></li>
						  <li><a href="change-password.php">Change Password</a></li>
					  	  <li><a href="./lib/login.php?act=logout">Logout</a></li>
					<?php } ?>
					<?php if($_SESSION['user_details']['user_level_id'] == 3) { ?> 
						<li><a href="./index.php">Home</a></li>
						<li><a href="./about.php">About Project</a></li>
						<li><a href="./events.php">Events</a></li>
						<li><a href="./my-works.php?user_id=<?php echo $_SESSION['user_details']['user_id']; ?>">My Works</a></li>
						<li><a href="change-password.php">Change Password</a></li>
						<li><a href="./lib/login.php?act=logout">Logout</a></li>
					<?php } ?>
					<?php if($_SESSION['user_details']['user_level_id'] == 2) { ?> 
						<li><a href="./index.php">Home</a></li>
						<li><a href="./about.php">About Project</a></li>
						<li><a href="./events.php">Events</a></li>
						<li><a href="./my-registration.php?user_id=<?php echo $_SESSION['user_details']['user_id']; ?>">My Registration</a></li>
						<li><a href="change-password.php">Change Password</a></li>
						<li><a href="./lib/login.php?act=logout">Logout</a></li>
					<?php } ?>
					</ul>
			</div>
		</div>
		<div class="col2">
			<h4 class="heading colr">Features</h4>
			<?php include_once("includes/sidebar.php"); ?> 
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 
