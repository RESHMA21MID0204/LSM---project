<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php"); 
	$SQL="SELECT * FROM `programs`, program_type WHERE programs_ptype_id = ptype_id and programs_event_id = '$_REQUEST[event_id]'";
	$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
	global $SERVER_PATH;
?>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1" style="width:100%">
		<div class="contact">
				<h4 class="heading colr">All Event Programs</h4>
			<form name="frm_programs" action="#" method="post">
				<div class="static">
					<table style="width:100%">
					  <tbody>
					  <tr class="tablehead bold">
						<td scope="col">ID </td>
						<td scope="col">Image</td>
						<td scope="col">Title</td>
						<td scope="col">Type</td>
						<td scope="col">Start Time</td>
						<td scope="col">End Time</td>
					  </tr>
					<?php 
					$sr_no=1;
					if(mysqli_num_rows($rs)) {
						while($data = mysqli_fetch_assoc($rs))
						{
					?>
					  <tr>
						<td style="text-align:center; font-weight:bold;"><?=$data[programs_id]?></td>
						<td><img src="<?=$SERVER_PATH.'uploads/'.$data[programs_image]?>" style="heigh:50px; width:50px"></td>
						<td><?=$data[programs_title]?></td>
						<td><?=$data[ptype_title]?></td>
						<td><?=$data[programs_start_time]?></td>
						<td><?=$data[programs_end_time]?></td>
					  </tr>
					<?php 
						}  
					}
					else {
						echo "<tr><td colspan='7'>No programs record found !!!</td></tr>";
					}
					?>
					</tbody>
					</table>
				</div>
				<input type="hidden" name="act" />
				<input type="hidden" name="programs_id" />
			</form>
		</div>
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 
