<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[theme_id])
	{
		$SQL="SELECT * FROM theme WHERE theme_id = $_REQUEST[theme_id]";
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
				<h4 class="heading colr">Add New Event Theme</h4>
				<form action="lib/theme.php" enctype="multipart/form-data" method="post" name="frm_theme">
					<ul class="forms">
						<li class="txt">Theme Title</li>
						<li class="inputfield"><input name="theme_title" type="text" class="bar" required value="<?=$data[theme_title]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Description</li>
						<li class="textfield"><textarea name="theme_description" cols="" rows="6" required><?=$data[theme_description]?></textarea></li>
					</ul>
					<div class="clear"></div>
					<ul class="forms">
						<li class="txt">&nbsp;</li>
						<li class="textfield"><input type="submit" value="Submit" class="simplebtn"></li>
						<li class="textfield"><input type="reset" value="Reset" class="resetbtn"></li>
					</ul>
					<input type="hidden" name="act" value="save_theme">
					<input type="hidden" name="theme_id" value="<?=$data[theme_id]?>">
				</form>
			</div>
		</div>
		<div class="col2">
			<?php include_once("includes/sidebar.php"); ?> 
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 