<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php");
	$SQL="SELECT * FROM program_type";
	$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
	global $SERVER_PATH;
?>
<script>
function delete_program_type(ptype_id)
{
	if(confirm("Do you want to delete the program_type?"))
	{
		this.document.frm_program_type.ptype_id.value=ptype_id;
		this.document.frm_program_type.act.value="delete_program_type";
		this.document.frm_program_type.submit();
	}
}
</script>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1" style="width:100%">
		<div class="contact">
				<h4 class="heading colr">Event Theme Reports</h4>
				<div class = "msg"><?=$_REQUEST['msg']?></div>
			<?php if(mysqli_num_rows($rs)) { ?>
			<form name="frm_program_type" action="lib/program_type.php" method="post">
				<div class="static">
					<table style="width:100%">
					  <tbody>
					  <tr class="tablehead bold">
						<td scope="col">Sr. No.</td>
						<td scope="col">Title</td>
						<td scope="col">Description</td>
						<td scope="col">Action</td>
					  </tr>
					<?php 
					$sr_no=1;
					while($data = mysqli_fetch_assoc($rs))
					{
					?>
					  <tr>
						<td style="text-align:center; font-weight:bold;"><?=$sr_no++?></td>
						<td><?=$data[ptype_title]?></td>
						<td><?=$data[ptype_description]?></td>
						<td style="text-align:center"><a href="program_type.php?ptype_id=<?php echo $data[ptype_id] ?>">Edit</a> | <a href="Javascript:delete_program_type(<?=$data[ptype_id]?>)">Delete</a> </td>
					  </tr>
					<?php } 
					}
					else {
					?>
						<div class = "msg">No Theme Found !!!</div>
					<?php
					}?>
					</tbody>
					</table>
				</div>
				<input type="hidden" name="act" />
				<input type="hidden" name="ptype_id" />
			</form>
		</div>
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 