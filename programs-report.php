<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php"); 
	if($_REQUEST[search_text]!="")
	{
		$SQL="SELECT * FROM `programs`, program_type WHERE programs_ptype_id = ptype_id AND programs_title LIKE '%$_REQUEST[search_text]%'";
	}
	else
	{
		$SQL="SELECT * FROM `programs`, program_type WHERE programs_ptype_id = ptype_id";
	}
	$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
	global $SERVER_PATH;
?>
<script>
function delete_programs(programs_id)
{
	if(confirm("Do you want to delete the programs?"))
	{
		this.document.frm_programs.programs_id.value=programs_id;
		this.document.frm_programs.act.value="delete_programs";
		this.document.frm_programs.action = "lib/programs.php";
		this.document.frm_programs.submit();
	}
}
</script>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1" style="width:100%">
		<div class="contact">
				<h4 class="heading colr">Programs Reports</h4>
			<form name="frm_programs" action="#" method="post">
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
						<td scope="col">Type</td>
						<td scope="col">Start Time</td>
						<td scope="col">End Time</td>
						<td scope="col">Action</td>
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
						<td style="text-align:center"><a href="programs.php?programs_id=<?php echo $data[programs_id] ?>">Edit</a> | <a href="Javascript:delete_programs(<?=$data[programs_id]?>)">Delete</a> </td>
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
