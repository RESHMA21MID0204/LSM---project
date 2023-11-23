<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php"); 
	$SQL="SELECT * FROM `event`, theme, event_registration, user WHERE event_theme_id =theme_id AND event_id = er_event_id AND er_student_id = user_id AND user_id = ".$_SESSION['user_details']['user_id'];
	$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
	global $SERVER_PATH;
?>
<script>
function delete_event(event_id)
{
	if(confirm("Do you want to delete the event?"))
	{
		this.document.frm_event.event_id.value=event_id;
		this.document.frm_event.act.value="delete_event";
		this.document.frm_event.action = "lib/event.php";
		this.document.frm_event.submit();
	}
}
</script>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1" style="width:100%">
		<div class="contact">
				<h4 class="heading colr">My Event Registration Report</h4>
			<form name="frm_event" action="#" method="post">
				<div class="static">
					<table style="width:100%">
					  <tbody>
					  <tr class="tablehead bold">
						<td scope="col">ID </td>
						<td scope="col">Image</td>
						<td scope="col">Title</td>
						<td scope="col">Event Theme</td>
						<td scope="col">Minimum Guest</td>
						<td scope="col">Maximum Guest</td>
						<td scope="col">Date</td>
					  </tr>
					<?php 
					$sr_no=1;
					if(mysqli_num_rows($rs)) {
						while($data = mysqli_fetch_assoc($rs))
						{
					?>
					  <tr>
						<td style="text-align:center; font-weight:bold;"><?=$data[event_id]?></td>
						<td>
						<a href="event_details.php?event_id=<?=$data[event_id]?>" class="thumb">
							<img src="<?=$SERVER_PATH.'uploads/'.$data[event_image]?>" style="heigh:50px; width:50px">
						</a>
						</td>
						<td><?=$data[event_title]?></td>
						<td><?=$data[theme_title]?></td>
						<td><?=$data[event_minimum_guest]?></td>
						<td><?=$data[event_maximum_guest]?></td>
						<td><?=$data[event_date]?></td>
					  </tr>
					<?php 
						}  
					}
					else {
						echo "<tr><td colspan='7'>No event record found !!!</td></tr>";
					}
					?>
					</tbody>
					</table>
				</div>
				<input type="hidden" name="act" />
				<input type="hidden" name="event_id" />
			</form>
		</div>
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 
