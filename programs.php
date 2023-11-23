<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[programs_id])
	{
		$SQL="SELECT * FROM programs WHERE programs_id = $_REQUEST[programs_id]";
		$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
		$data=mysqli_fetch_assoc($rs);
	}
?> 
<script>

jQuery(function() {
	jQuery( "#programs_date" ).datepicker({
	  changeMonth: true,
	  changeYear: true,
	   yearRange: "-1:+1",
	   dateFormat: 'd MM,yy'
	});
	jQuery('#frm_programs').validate({
		rules: {
			programs_confirm_password: {
				equalTo: '#programs_password'
			}
		}
	});
});
</script>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1">
			<div class="contact">
				<h4 class="heading colr">Programs Registration</h4>
				<?php
				if($_REQUEST['msg']) { 
				?>
				<div class="msg"><?=$_REQUEST['msg']?></div>
				<?php
				}
				?>
				<form action="lib/programs.php" enctype="multipart/form-data" method="post" name="frm_programs">
					<ul class="forms">
						<li class="txt">Title</li>
						<li class="inputfield"><input name="programs_title" type="text" class="bar" required value="<?=$data[programs_title]?>"/></li>
					</ul>
					<ul class="forms" id="programs_level">
						<li class="txt">Select Event</li>
						<li class="inputfield">
							<select name="programs_event_id" id="programs_event_id" class="bar" required/>
								<?php echo get_new_optionlist("event","event_id","event_title",$data[programs_event_id]); ?>
							</select>
						</li>
					</ul>
					<ul class="forms" id="programs_level">
						<li class="txt">Program Type</li>
						<li class="inputfield">
							<select name="programs_ptype_id" id="programs_ptype_id" class="bar" required/>
								<?php echo get_new_optionlist("program_type","ptype_id","ptype_title",$data[programs_ptype_id]); ?>
							</select>
						</li>
					</ul>
					<ul class="forms">
						<li class="txt">Start Time</li>
						<li class="inputfield"><input name="programs_start_time" type="text" class="bar" required value="<?=$data[programs_start_time]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">End Time</li>
						<li class="inputfield"><input name="programs_end_time" id="programs_end_time" type="text" class="bar" required value="<?=$data[programs_end_time]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Participants</li>
						<li class="inputfield"><input name="programs_participants" type="text" class="bar" required value="<?=$data[programs_participants]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Photo</li>
						<li class="inputfield"><input name="programs_image" type="file" class="bar"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Description</li>
						<li class="textfield"><textarea name="programs_description" cols="" rows="6" required><?=$data[programs_description]?></textarea></li>
					</ul>
					<div class="clear"></div>
					<ul class="forms">
						<li class="txt">&nbsp;</li>
						<li class="textfield"><input type="submit" value="Submit" class="simplebtn"></li>
						<li class="textfield"><input type="reset" value="Reset" class="resetbtn"></li>
					</ul>
					<input type="hidden" name="act" value="save_programs">
					<input type="hidden" name="avail_image" value="<?=$data[programs_image]?>">
					<input type="hidden" name="programs_id" value="<?=$data[programs_id]?>">
				</form>
			</div>
		</div>
		<div class="col2">
			<?php include_once("includes/sidebar.php"); ?> 
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 