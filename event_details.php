<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php"); 
	$SQL="SELECT * FROM `event`, theme, event_status WHERE event_status_id = es_id AND event_theme_id = theme_id AND event_id = $_REQUEST[event_id]";
	$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
	$data=mysqli_fetch_assoc($rs);

	/// Get the User is registered or not ///
	$hide = 0;
	if($_SESSION['login'] == 1) {
		$SQL="SELECT * FROM `event_registration` WHERE er_student_id = ".$_SESSION['user_details']['user_id']." AND er_event_id = $_REQUEST[event_id]";
		$rs1=mysqli_query($con,$SQL) or die(mysqli_error($con));
		if(mysqli_num_rows($rs1)) {
			$hide = 1;
		}
	}
	
	global $SERVER_PATH;
?> 
<script>
function openBooking(event_id) {
	window.location.href= "make_payment.php?event_id="+event_id;
}
function openLogin(event_id) {
	window.location.href= "login.php";
}
</script>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1" style="width:100%">
			<h4 class="heading colr">Details of Event <?=$data['event_title']?></h4>
        <div>
			<div style="float:left; border:3px solid #d71921; padding:1px; border-radius:3px;"><img src="<?=$SERVER_PATH.'uploads/'.$data[event_image]?>" style="height:320px; width:300px;"></div>
			<div style="float:left; width:600px; margin-left:20px;" class="static">
			<div class='msg'><?=$_REQUEST['msg']?></div>
				<table>
					<tr>
						<td class="tablehead" style="width:150px;">Name</td>
						<td><?=$data["event_title"]?> &nbsp;&nbsp;&nbsp;(<a style="color:#ff0000; text-decoration:underline; font-weight:bold; font-size:12px;" href="programs-listing.php?event_id=<?=$data['event_id']?>">View Programs</a>)</td>
					</tr>
					<tr>
						<td class="tablehead">Date</td>
						<td><?=$data["event_date"]?></td>
					</tr>
					<tr>
						<td class="tablehead">Theme</td>
						<td><?=$data["theme_title"]?></td>
					</tr>
					<tr>
						<td class="tablehead">Status</td>
						<td><?=$data["es_title"]?></td>
					</tr>
					<tr>
						<td class="tablehead">Minimum Guest Allowed</td>
						<td><?=$data["event_minimum_guest"]?></td>
					</tr>
					<tr>
						<td class="tablehead">Maximum Guest Allowed</td>
						<td><?=$data["event_maximum_guest"]?></td>
					</tr>
					<tr>
						<td class="tablehead">Description</td>
						<td>
						<?=$data["event_description"]?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
						
						<div class="product-price" style="text-align:center;">
						<?php if($_SESSION['login'] == 1) {?>
							<?php if($hide == 0) { ?>
								<input type="button" value="Join Event" class="simplebtn" onClick="openBooking(<?=$data['event_id']?>)">
							<?php } else { ?>
								<div class='msg'>You have already registered for the event.</div>
							<?php } ?>
						<?php } else { ?>
							<input type="button" value="Login to Join" class="simplebtn" onClick="openLogin()">
						<?php } ?>
						</div>
						
						</td>
					</tr>
				</table>
			</div>
        </div>
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 