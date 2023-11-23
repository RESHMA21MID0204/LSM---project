<?php
	include_once("../includes/db_connect.php");
	include_once("../includes/functions.php");
	if($_REQUEST[act]=="save_program_type")
	{
		save_program_type();
		exit;
	}
	if($_REQUEST[act]=="delete_program_type")
	{
		delete_program_type();
		exit;
	}
	###Code for save program_type#####
	function save_program_type()
	{
		global $con;
		$R=$_REQUEST;
		if($R[ptype_id])
		{
			$statement = "UPDATE `program_type` SET";
			$cond = "WHERE `ptype_id` = '$R[ptype_id]'";
			$msg = "Data Updated Successfully.";
		}
		else
		{
			$statement = "INSERT INTO `program_type` SET";
			$cond = "";
			$msg="Data saved successfully.";
		}
		$SQL=   $statement." 
				`ptype_title` = '$R[ptype_title]', 
				`ptype_description` = '$R[ptype_description]'". 
				 $cond;
		$rs = mysqli_query($con,$SQL) or die(mysqli_error($con));
		header("Location:../program_type-report.php?msg=$msg");
	}
#########Function for delete program_type##########3
function delete_program_type()
{
	global $con;
	/////////Delete the record//////////
	$SQL="DELETE FROM program_type WHERE ptype_id = $_REQUEST[ptype_id]";
	mysqli_query($con,$SQL) or die(mysqli_error($con));
	
	header("Location:../program_type-report.php?msg=Deleted Successfully.");
}
?>