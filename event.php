<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[event_id])
	{
		$SQL="SELECT * FROM event WHERE event_id = $_REQUEST[event_id]";
		$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
		$data=mysqli_fetch_assoc($rs);
	}
?> 
<script>

jQuery(function() {
	jQuery( "#event_date" ).datepicker({
	  changeMonth: true,
	  changeYear: true,
	   yearRange: "-1:+1",
	   dateFormat: 'd MM,yy'
	});
	jQuery('#frm_event').validate({
		rules: {
			event_confirm_password: {
				equalTo: '#event_password'
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
				<h4 class="heading colr">Event Registration</h4>
				<?php
				if($_REQUEST['msg']) { 
				?>
				<div class="msg"><?=$_REQUEST['msg']?></div>
				<?php
				}
				?>
				<form action="lib/event.php" enctype="multipart/form-data" method="post" name="frm_event">
					<ul class="forms">
						<li class="txt">Event Title</li>
						<li class="inputfield"><input name="event_title" type="text" class="bar" required value="<?=$data[event_title]?>"/></li>
					</ul>
					<ul class="forms" id="event_level">
						<li class="txt">Event Theme</li>
						<li class="inputfield">
							<select name="event_theme_id" id="event_theme_id" class="bar" required/>
								<?php echo get_new_optionlist("theme","theme_id","theme_title",$data[event_theme_id]); ?>
							</select>
						</li>
					</ul>
					<ul class="forms" id="event_level">
						<li class="txt">Event Status</li>
						<li class="inputfield">
							<select name="event_status_id" id="event_status_id" class="bar" required/>
								<?php echo get_new_optionlist("event_status","es_id","es_title",$data[event_status_id]); ?>
							</select>
						</li>
					</ul>
					<ul class="forms">
						<li class="txt">Minimum Guest</li>
						<li class="inputfield"><input name="event_minimum_guest" type="text" class="bar" required value="<?=$data[event_minimum_guest]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Maximum Guest</li>
						<li class="inputfield"><input name="event_maximum_guest" id="event_password" type="text" class="bar" required value="<?=$data[event_maximum_guest]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Date</li>
						<li class="inputfield"><input name="event_date" type="text" class="bar" required value="<?=$data[event_date]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Photo</li>
						<li class="inputfield"><input name="event_image" type="file" class="bar"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Description</li>
						<li class="textfield"><textarea name="event_description" cols="" rows="6" required><?=$data[event_description]?></textarea></li>
					</ul>
					<div class="clear"></div>
					<ul class="forms">
						<li class="txt">&nbsp;</li>
						<li class="textfield"><input type="submit" value="Submit" class="simplebtn"></li>
						<li class="textfield"><input type="reset" value="Reset" class="resetbtn"></li>
					</ul>
					<input type="hidden" name="act" value="save_event">
					<input type="hidden" name="avail_image" value="<?=$data[event_image]?>">
					<input type="hidden" name="event_id" value="<?=$data[event_id]?>">
				</form>
			</div>
		</div>
		<div class="col2">
			<?php include_once("includes/sidebar.php"); ?> 
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 