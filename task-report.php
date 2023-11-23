<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php");
	$SQL="SELECT * FROM task, user WHERE user_id = task_user_id";
	$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
	global $SERVER_PATH;
?>
<script>
function delete_task(task_id)
{
	if(confirm("Do you want to delete the task?"))
	{
		this.document.frm_task.task_id.value=task_id;
		this.document.frm_task.act.value="delete_task";
		this.document.frm_task.submit();
	}
}
</script>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1" style="width:100%">
		<div class="contact">
				<h4 class="heading colr">Volunteers Task Reports</h4>
				<div class = "msg"><?=$_REQUEST['msg']?></div>
			<?php if(mysqli_num_rows($rs)) { ?>
			<form name="frm_task" action="lib/task.php" method="post">
				<div class="static">
					<table style="width:100%">
					  <tbody>
					  <tr class="tablehead bold">
						<td scope="col">Sr. No.</td>
						<td scope="col">Volunteers</td>
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
						<td><?=$data[user_name]?></td>
						<td><?=$data[task_title]?></td>
						<td><?=$data[task_description]?></td>
						<td style="text-align:center"><a href="task.php?task_id=<?php echo $data[task_id] ?>">Edit</a> | <a href="Javascript:delete_task(<?=$data[task_id]?>)">Delete</a> </td>
					  </tr>
					<?php } 
					}
					else {
					?>
						<div class = "msg">No Task Found !!!</div>
					<?php
					}?>
					</tbody>
					</table>
				</div>
				<input type="hidden" name="act" />
				<input type="hidden" name="task_id" />
			</form>
		</div>
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 