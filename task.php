<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[task_id])
	{
		$SQL="SELECT * FROM task WHERE task_id = $_REQUEST[task_id]";
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
				<h4 class="heading colr">Add New Volunteer Task</h4>
				<form action="lib/task.php" enctype="multipart/form-data" method="post" name="frm_task">
					<ul class="forms" id="event_level">
						<li class="txt">Select Volunteer</li>
						<li class="inputfield">
							<select name="task_user_id" id="task_user_id" class="bar" required/>
								<?php echo get_new_optionlist("user","user_id","user_name",$data[task_user_id], "user_level_id = 3"); ?>
							</select>
						</li>
					</ul>
					<ul class="forms">
						<li class="txt">Task Title</li>
						<li class="inputfield"><input name="task_title" type="text" class="bar" required value="<?=$data[task_title]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Description</li>
						<li class="textfield"><textarea name="task_description" cols="" rows="6" required><?=$data[task_description]?></textarea></li>
					</ul>
					<div class="clear"></div>
					<ul class="forms">
						<li class="txt">&nbsp;</li>
						<li class="textfield"><input type="submit" value="Submit" class="simplebtn"></li>
						<li class="textfield"><input type="reset" value="Reset" class="resetbtn"></li>
					</ul>
					<input type="hidden" name="act" value="save_task">
					<input type="hidden" name="task_id" value="<?=$data[task_id]?>">
				</form>
			</div>
		</div>
		<div class="col2">
			<?php include_once("includes/sidebar.php"); ?> 
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 