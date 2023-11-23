<?php
	include_once("../includes/db_connect.php");
	include_once("../includes/functions.php");
	if($_REQUEST[act]=="save_task")
	{
		save_task();
		exit;
	}
	if($_REQUEST[act]=="delete_task")
	{
		delete_task();
		exit;
	}
	###Code for save task#####
	function save_task()
	{
		global $con;
		$R=$_REQUEST;
		if($R[task_id])
		{
			$statement = "UPDATE `task` SET";
			$cond = "WHERE `task_id` = '$R[task_id]'";
			$msg = "Data Updated Successfully.";
		}
		else
		{
			$statement = "INSERT INTO `task` SET";
			$cond = "";
			$msg="Data saved successfully.";
		}
		$SQL=   $statement." 
				`task_user_id` = '$R[task_user_id]', 
				`task_title` = '$R[task_title]', 
				`task_description` = '$R[task_description]'
				". 
				 $cond;
		$rs = mysqli_query($con,$SQL) or die(mysqli_error($con));
		header("Location:../task-report.php?msg=$msg");
	}
#########Function for delete task##########3
function delete_task()
{
	global $con;
	/////////Delete the record//////////
	$SQL="DELETE FROM task WHERE task_id = $_REQUEST[task_id]";
	mysqli_query($con,$SQL) or die(mysqli_error($con));
	
	header("Location:../task-report.php?msg=Deleted Successfully.");
}
?>