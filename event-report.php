<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php"); 
	if($_REQUEST[search_text]!="")
	{
		$SQL="SELECT * FROM `event`, theme WHERE event_theme_id = theme_id AND event_title LIKE '%$_REQUEST[search_text]%'";
	}
	else
	{
		$SQL="SELECT * FROM `event`, theme WHERE event_theme_id = theme_id";
	}
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
				<h4 class="heading colr">Event Reports</h4>
			<form name="frm_event" action="#" method="post">
				<div class="static">
					<table style="width:100%">
					  <tbody>
					  <tr>
						<td colspan="7">Search : <input type="text" name="search_text" class="inputfield" style="height: 23px; width: 229px;">&nbsp;&nbsp;<input type="submit" value="Search" class="simplebtn"></td>
					  </tr>
					  <tr class="tablehead bold">
						<td scope="col">ID </td>
						<td scope="col">Image</td>
						<td scope="col">Title</td>
						<td scope="col">Event Theme</td>
						<td scope="col">Minimum Guest</td>
						<td scope="col">Maximum Guest</td>
						<td scope="col">Date</td>
						<td scope="col">Action</td>
					  </tr>
					<?php 
					$sr_no=1;
					if(mysqli_num_rows($rs)) {
						while($data = mysqli_fetch_assoc($rs))
						{
					?>
					  <tr>
						<td style="text-align:center; font-weight:bold;"><?=$data[event_id]?></td>
						<td><img src="<?=$SERVER_PATH.'uploads/'.$data[event_image]?>" style="heigh:50px; width:50px"></td>
						<td><?=$data[event_title]?></td>
						<td><?=$data[theme_title]?></td>
						<td><?=$data[event_minimum_guest]?></td>
						<td><?=$data[event_maximum_guest]?></td>
						<td><?=$data[event_date]?></td>
						<td style="text-align:center"><a href="event.php?event_id=<?php echo $data[event_id] ?>">Edit</a> | <a href="Javascript:delete_event(<?=$data[event_id]?>)">Delete</a> </td>
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
