<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php");
	$SQL="SELECT * FROM theme";
	$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
	global $SERVER_PATH;
?>
<script>
function delete_theme(theme_id)
{
	if(confirm("Do you want to delete the theme?"))
	{
		this.document.frm_theme.theme_id.value=theme_id;
		this.document.frm_theme.act.value="delete_theme";
		this.document.frm_theme.submit();
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
			<form name="frm_theme" action="lib/theme.php" method="post">
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
						<td><?=$data[theme_title]?></td>
						<td><?=$data[theme_description]?></td>
						<td style="text-align:center"><a href="theme.php?theme_id=<?php echo $data[theme_id] ?>">Edit</a> | <a href="Javascript:delete_theme(<?=$data[theme_id]?>)">Delete</a> </td>
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
				<input type="hidden" name="theme_id" />
			</form>
		</div>
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 