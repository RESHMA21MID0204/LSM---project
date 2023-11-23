<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[ptype_id])
	{
		$SQL="SELECT * FROM program_type WHERE ptype_id = $_REQUEST[ptype_id]";
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
				<form action="lib/program_type.php" enctype="multipart/form-data" method="post" name="frm_program_type">
					<ul class="forms">
						<li class="txt">Title</li>
						<li class="inputfield"><input name="ptype_title" type="text" class="bar" required value="<?=$data[ptype_title]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Description</li>
						<li class="textfield"><textarea name="ptype_description" cols="" rows="6" required><?=$data[ptype_description]?></textarea></li>
					</ul>
					<div class="clear"></div>
					<ul class="forms">
						<li class="txt">&nbsp;</li>
						<li class="textfield"><input type="submit" value="Submit" class="simplebtn"></li>
						<li class="textfield"><input type="reset" value="Reset" class="resetbtn"></li>
					</ul>
					<input type="hidden" name="act" value="save_program_type">
					<input type="hidden" name="ptype_id" value="<?=$data[ptype_id]?>">
				</form>
			</div>
		</div>
		<div class="col2">
			<?php include_once("includes/sidebar.php"); ?> 
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 